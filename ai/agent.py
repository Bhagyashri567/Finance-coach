#!/usr/bin/env python3
import json
import os
import sys
import time
from datetime import datetime
import pymysql


MEMORY_DIR = os.path.join(os.path.dirname(__file__), "memory")
CONV_MEMORY_FILE = os.path.join(MEMORY_DIR, "conversations.jsonl")
USER_FACTS_FILE = os.path.join(MEMORY_DIR, "user_facts.json")


def ensure_memory():
	if not os.path.exists(MEMORY_DIR):
		os.makedirs(MEMORY_DIR, exist_ok=True)
	if not os.path.exists(CONV_MEMORY_FILE):
		with open(CONV_MEMORY_FILE, "w", encoding="utf-8") as f:
			f.write("")
	if not os.path.exists(USER_FACTS_FILE):
		with open(USER_FACTS_FILE, "w", encoding="utf-8") as f:
			json.dump({}, f)


def load_user_facts():
	try:
		with open(USER_FACTS_FILE, "r", encoding="utf-8") as f:
			return json.load(f)
	except Exception:
		return {}


def save_user_facts(facts):
	try:
		with open(USER_FACTS_FILE, "w", encoding="utf-8") as f:
			json.dump(facts, f)
	except Exception:
		pass


def append_conversation(turn):
	try:
		with open(CONV_MEMORY_FILE, "a", encoding="utf-8") as f:
			f.write(json.dumps(turn, ensure_ascii=False) + "\n")
	except Exception:
		pass


def tool_spending_summary(user_id: str, facts: dict) -> str:
	data = facts.get(user_id, {}).get("spending", {
		"Food": 2200,
		"Transport": 1500,
		"Rent": 12000,
		"Shopping": 4000,
		"Other": 1800,
	})
	total = sum(data.values())
	biggest = max(data, key=data.get)
	return f"This month you've spent Rs {total:,}. Biggest category: {biggest} (Rs {data[biggest]:,})."


def tool_income_variability(user_id: str, facts: dict) -> str:
	series = facts.get(user_id, {}).get("income_series", [30000, 35000, 32000, 36000, 42000])
	if not series:
		return "I don't have your income history yet. Consider uploading a CSV in Budgets."
	avg = sum(series) / len(series)
	min_val, max_val = min(series), max(series)
	vol = (max_val - min_val) / max(avg, 1)
	vol_bucket = "low" if vol < 0.2 else ("medium" if vol < 0.5 else "high")
	return f"Your average monthly income is Rs {int(avg):,} with {vol_bucket} variability (min Rs {min_val:,}, max Rs {max_val:,})."


def tool_goal_planner(user_id: str, facts: dict, goal: str = "Emergency Fund", target: int = 50000) -> str:
	current = facts.get(user_id, {}).get("goals", {}).get(goal, 34000)
	remaining = max(target - current, 0)
	if remaining == 0:
		return f"Great! You have met your {goal} goal. Consider starting a new goal."
	return f"You're {int((current/target)*100)}% towards your {goal} (Rs {current:,}/Rs {target:,}). Remaining: Rs {remaining:,}."


def reflect_and_update_facts(user_id: str, user_message: str, facts: dict) -> None:
	msg = user_message.lower()
	if "i got paid" in msg or "my income" in msg:
		facts.setdefault(user_id, {}).setdefault("events", []).append({
			"type": "income_note",
			"text": user_message,
			"ts": datetime.utcnow().isoformat(),
		})
		save_user_facts(facts)


def agent_plan(user_id: str, user_message: str, facts: dict) -> list:
	msg = user_message.lower()
	steps = []
	if any(k in msg for k in ["spend", "spending", "budget", "expense", "expenses"]):
		steps.append({"tool": "spending_summary"})
	if any(k in msg for k in ["income", "paid", "salary", "gig"]):
		steps.append({"tool": "income_variability"})
	if any(k in msg for k in ["goal", "save", "saving", "emergency", "laptop"]):
		steps.append({"tool": "goal_planner"})
	if not steps:
		steps = [{"tool": "spending_summary"}, {"tool": "income_variability"}]
	return steps[:3]


def agent_act(step, user_id: str, facts: dict) -> str:
	name = step.get("tool")
	if name == "spending_summary":
		return tool_spending_summary(user_id, facts)
	if name == "income_variability":
		return tool_income_variability(user_id, facts)
	if name == "goal_planner":
		return tool_goal_planner(user_id, facts)
	return "(no-op)"


def agent_respond(user_id: str, user_message: str) -> dict:
	ensure_memory()
	facts = load_user_facts()
	reflect_and_update_facts(user_id, user_message, facts)
	plan = agent_plan(user_id, user_message, facts)
	observations = []
	for step in plan:
		obs = agent_act(step, user_id, facts)
		observations.append({"tool": step.get("tool"), "result": obs})
		time.sleep(0.05)

	final_parts = [o["result"] for o in observations]
	reco = "Consider earmarking 10-20% of variable income for a buffer each week to smooth cashflow."
	final_text = " \n".join(final_parts + [reco])
	result = {
		"reply": final_text,
		"steps": plan,
		"observations": observations,
		"ts": datetime.utcnow().isoformat(),
	}

	# persist lightweight insight and conversation into DB if available
	try:
		conn = pymysql.connect(host=os.getenv('DB_HOST','127.0.0.1'), user=os.getenv('DB_USER','root'), password=os.getenv('DB_PASS',''), database=os.getenv('DB_NAME','financecoach'), charset='utf8mb4', cursorclass=pymysql.cursors.Cursor)
		with conn.cursor() as cur:
			cur.execute("INSERT INTO conversations (user_id, user_message, assistant_reply) VALUES (%s,%s,%s)", (0 if user_id=='guest' else int(user_id), user_message, final_text))
			# derive a short insight from reply first line
			short = final_text.split("\n",1)[0][:240]
			cur.execute("INSERT INTO insights (user_id, text, priority) VALUES (%s,%s,%s)", (0 if user_id=='guest' else int(user_id), short, 5))
			conn.commit()
	except Exception as e:
		# Database not available, continue without persistence
		pass

	return result


def main():
	try:
		payload = sys.stdin.read()
		data = json.loads(payload or "{}")
		user_message = data.get("message", "")
		user_id = data.get("user_id", "guest")
		if not user_message:
			print(json.dumps({"error": "Empty message"}))
			return
		result = agent_respond(user_id, user_message)
		append_conversation({
			"user_id": user_id,
			"user": user_message,
			"assistant": result.get("reply", ""),
			"ts": result.get("ts"),
		})
		print(json.dumps(result, ensure_ascii=False))
	except Exception as e:
		print(json.dumps({"error": str(e)}))


if __name__ == "__main__":
	main()
