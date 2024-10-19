let clients = [
    { id: 1, name: 'João', email: 'joao@example.com', gender: 'Masculino', dob: '1990-01-01' },
    { id: 2, name: 'Maria', email: 'maria@example.com', gender: 'Feminino', dob: '1985-05-15' },
    // Adicione mais clientes conforme necessário
];

document.addEventListener('DOMContentLoaded', () => {
    renderClients(clients);
});

function renderClients(clients) {
    const tableBody = document.querySelector('#client-table tbody');
    tableBody.innerHTML = '';

    clients.forEach(client => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${client.name}</td>
            <td>${client.email}</td>
            <td>${client.gender}</td>
            <td>${client.dob}</td>
            <td class="actions">
                <button onclick="editClient(${client.id})">Editar</button>
                <button onclick="deleteClient(${client.id})">Deletar</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function editClient(id) {
    const client = clients.find(client => client.id === id);
    document.getElementById('client-id').value = client.id;
    document.getElementById('client-name').value = client.name;
    document.getElementById('client-email').value = client.email;
    document.getElementById('client-gender').value = client.gender;
    document.getElementById('client-dob').value = client.dob;
    document.getElementById('client-form').style.display = 'flex';
}

function saveClient() {
    const id = document.getElementById('client-id').value;
    const name = document.getElementById('client-name').value;
    const email = document.getElementById('client-email').value;
    const gender = document.getElementById('client-gender').value;
    const dob = document.getElementById('client-dob').value;

    if (id) {
        const client = clients.find(client => client.id === parseInt(id));
        client.name = name;
        client.email = email;
        client.gender = gender;
        client.dob = dob;
    } else {
        const newClient = {
            id: clients.length ? clients[clients.length - 1].id + 1 : 1,
            name,
            email,
            gender,
            dob
        };
        clients.push(newClient);
    }

    document.getElementById('client-form').style.display = 'none';
    renderClients(clients);
}

function deleteClient(id) {
    clients = clients.filter(client => client.id !== id);
    renderClients(clients);
}

document.getElementById('search').addEventListener('input', (event) => {
    const searchTerm = event.target.value.toLowerCase();
    const filteredClients = clients.filter(client => 
        client.name.toLowerCase().includes(searchTerm) ||
        client.email.toLowerCase().includes(searchTerm) ||
        client.gender.toLowerCase().includes(searchTerm) ||
        client.dob.includes(searchTerm)
    );
    renderClients(filteredClients);
});
