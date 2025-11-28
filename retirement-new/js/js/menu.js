document.addEventListener('DOMContentLoaded', () => {
    const menuElement = document.getElementById('dynamic-menu');
    if (menuElement) {
        const menuItems = [
            { name: 'Left1', link: '#' },
            { name: 'Left2', link: '#' },
            { name: 'Left3', link: '#' }
        ];
        menuItems.forEach(item => {
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.textContent = item.name;
            a.href = item.link;
            li.appendChild(a);
            menuElement.appendChild(li);
        });
    }
});