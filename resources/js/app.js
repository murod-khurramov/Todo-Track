import './bootstrap';

function toggleTask(taskId) {
    const checkbox = document.querySelector(`.checkbox[data-id="${taskId}"]`);
    const completed = checkbox.checked ? 1 : 0; // true or false, but sending 1 or 0

    fetch(`/tasks/toggle/${taskId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ completed: completed }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const taskTitle = document.querySelector(`.task-title[data-id="${taskId}"]`);
                taskTitle.classList.toggle('line-through');
            }
        });
}
