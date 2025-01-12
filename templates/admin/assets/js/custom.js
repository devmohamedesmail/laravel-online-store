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



// Add Section Options




document.addEventListener('DOMContentLoaded', function() {
    let optionCount = 0;  // Keeps track of how many rows are added

    // Event listener for "Add Option" button
    document.getElementById('add-option-btn').addEventListener('click', function() {
        optionCount++;

        // Create new row of input fields
        let row = document.createElement('div');
        row.classList.add('row');
        row.innerHTML = `
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="option-name-${optionCount}">Option Name</label>
                    <input type="text" class="form-control" name="option_name[]" id="option-name-${optionCount}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="option-price-${optionCount}">Option Price</label>
                    <input type="text" class="form-control" name="option_price[]" id="option-price-${optionCount}">
                </div>
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-danger remove-option-btn">Delete</button>
            </div>
        `;

        // Append the new row to the container
        document.getElementById('options-container').appendChild(row);

        // Attach event listener for the delete button in the new row
        row.querySelector('.remove-option-btn').addEventListener('click', function() {
            row.remove();
        });
    });
});




// select product type
const switchBtn = document.getElementById('switch');
const attributeContainer = document.getElementById('product-attribute-variation-container').style.display = 'none';

switchBtn.addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('product-attribute-variation-container').style.display = 'block';
    } else {
        document.getElementById('product-attribute-variation-container').style.display = 'none';
    }
})
