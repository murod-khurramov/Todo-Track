// resources/js/dashboard.js
function toggleEditForm(taskId) {
    const editForm = document.getElementById(`edit-form-${taskId}`);
    editForm.classList.toggle('hidden');
}
