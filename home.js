const imageinput = document.getElementById('ima');
const imagepreview = document.getElementById('image-preview');

imageinput.addEventListener('change',(e) => {

    const file = imageinput.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', (e) => {

        imagepreview.src = e.target.result;
    })
    reader.readAsDataURL(file);
})

function toggle_dropdown(){

    var droppdown = document.getElementById('mydrop');

    if(droppdown.style.display === "block"){
        droppdown.style.display = "none";
    }else{

        droppdown.style.display ="block";
    }

    if (!event.target.matches('.yy')) {
        var dropdowns = document.getElementsByClassName("drop_down");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }


}