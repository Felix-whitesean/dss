import './bootstrap';
function renderPage(page) {

    const container = document.getElementById('container');
    console.log(container)
    if (!container) return;

    const reportFields = [
        { name: "name", label: "Full Name", type: "text", page: 1 },
        { name: "phone", label: "Phone Number", type: "tel", page: 1 },

        { name: "national_id", label: "National ID", type: "text", page: 2 },
        { name: "passport", label: "Passport Number", type: "text", page: 2 },

        { name: "age", label: "Age", type: "text", page: 3 },
        { name: "gender", label: "Gender", type: "text", page: 3 },
            ];

        container.innerHTML = '';

        const fields = reportFields.filter(f => f.page === page);

        fields.forEach(field => {

        const wrapper = document.createElement('div');
        wrapper.className = 'mb-4 flex flex-col';

        const label = document.createElement('label');
        label.className = 'mb-1 font-medium';
        label.textContent = field.label;

        const input = document.createElement('input');
        input.type = field.type;
        input.className = 'border rounded p-2';

        wrapper.appendChild(label);
        wrapper.appendChild(input);
        container.appendChild(wrapper);
    });
}
