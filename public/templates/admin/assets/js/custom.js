// "use strict";



document.addEventListener("DOMContentLoaded",function(){
 // category slug
 const category_name = document.querySelector("#category_name");

 function generateSlug() {
     const slug = category_name.value
         .toLowerCase()
         .replace(/ /g, "-")
         .replace(/[^\w-]+/g, "");

     const randomNumber = Math.floor(Math.random() * 10000);
     const uniqueSlug = slug + "-" + randomNumber;
     document.querySelector("#slug").value = uniqueSlug;
 }

 category_name.addEventListener("change", generateSlug);
})


document.addEventListener("DOMContentLoaded", (event) => {
    event.preventDefault();
    $(".inputtags").tagsinput();

    // Prevent form submission when pressing Enter in tags input
    document.querySelectorAll(".inputtags").forEach((input) => {
        input.addEventListener("keypress", (event) => {
            if (event.key === "Enter") {
                event.preventDefault(); // Stop form submission
            }
        });

        input.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                event.preventDefault(); // Extra safety for Enter key
            }
        });
    });

    // Handle form submission
    const form = document.getElementById("tag-form");
    const submitButton = document.querySelector('button[type="submit"]');

    submitButton.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default just in case
        form.submit(); // Submit the form explicitly
    });

    // Prevent form submission if Enter is pressed elsewhere in the form
    form.addEventListener("keypress", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

   
});
