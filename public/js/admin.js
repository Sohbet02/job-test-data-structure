document.addEventListener("DOMContentLoaded", function (event) {
    
    async function fetchData(id) {

        let response = await fetch('/admin/data/get', {
            method: "POST",
            body: JSON.stringify(id)
        });

        return await response.json();
    
    }

    async function loadEditData() { 
        let data = await fetchData(editData.value);
        name.value = data.name;
        description.innerHTML = data.description;
        parent.value = data.parent ? data.parent : 0;

        parent.querySelectorAll('option').forEach(function(el) {
            if (el.value == editData.value) {
                el.setAttribute("disabled", true);
            } else {
                el.removeAttribute("disabled");
            }
        })
    }
    
    var editData = document.querySelector(".edit-data select[name='data']");
    const name = document.querySelector(".edit-data input[name='name']");
    const description = document.querySelector(".edit-data textarea[name='description']");
    const parent = document.querySelector(".edit-data select[name='parent']");

    editData.addEventListener("change", loadEditData)
    
    loadEditData();
});