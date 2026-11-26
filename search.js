const form = document.querySelector('#search');
const results = document.querySelector('#results');
let timer, controller;
async function search() {
  if (controller) controller.abort();
  controller = new AbortController();
  try {
    const response = await fetch('ajax_search.php?' + new URLSearchParams(new FormData(form)), {signal: controller.signal});
    if (response.redirected) { location.href = response.url; return; }
    if (!response.ok) throw new Error('Search failed');
    results.innerHTML = await response.text(); // Server-rendered, Twig-escaped HTML.
  } catch (error) { if (error.name !== 'AbortError') results.textContent = 'Search failed. Check your filters.'; }
}
form.addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(search, 300); });
form.addEventListener('submit', event => { event.preventDefault(); clearTimeout(timer); search(); });
