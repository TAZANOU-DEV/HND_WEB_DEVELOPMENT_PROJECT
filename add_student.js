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


window.onload = function(){
    const savedimage = localStorage.getItem("uploadedimage");
    if(savedimage){

        imagepreview.src = savedimage;
        imagepreview.style.display = "block";
    }
};

imageinput.addEventListener("change", function(event){
    const file = event.target.addEventListener.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            imagepreview.src = e.target.result;
            imagepreview.style.display = "block";
            localStorage.setItem("uploadedimage",e.target.result);
        };
        reader.readAsDataURL(file);
    }

});
