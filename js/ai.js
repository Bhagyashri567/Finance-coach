async function sendToAgent(message) {
	console.log('sendToAgent called with:', message);
	console.log('Current URL:', window.location.href);
	console.log('Base URL:', window.location.origin + window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/')));
	
	const apiUrl = 'api/agent.php';
	console.log('Fetching from:', apiUrl);
	console.log('Full URL would be:', window.location.origin + '/' + apiUrl);
	
	const res = await fetch(apiUrl, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({ message })
	});
	
	console.log('Response status:', res.status);
	console.log('Response ok:', res.ok);
	console.log('Response URL:', res.url);
	
	if (!res.ok) {
		throw new Error(`HTTP error! status: ${res.status}`);
	}
	
	const text = await res.text();
	console.log('Raw response text:', text);
	
	try {
		const data = JSON.parse(text);
		console.log('Parsed response data:', data);
		return data;
	} catch (e) {
		console.error('Failed to parse JSON:', e);
		console.error('Response was:', text);
		throw new Error('Invalid JSON response: ' + text.substring(0, 100));
	}
}

console.log('ai.js loaded, creating FinAI object');
window.FinAI = { sendToAgent };
console.log('FinAI object created:', window.FinAI);


