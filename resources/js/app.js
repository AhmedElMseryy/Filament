import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    const selectAllBtn = document.getElementById("selectAllBtn");
    if (selectAllBtn) {
        selectAllBtn.addEventListener("click", function () {
            document.querySelectorAll('.permissions-group input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = true;
            });
        });
    }
});