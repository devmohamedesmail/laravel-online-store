<script>
       


       document.getElementById("add-attribute-btn").addEventListener("click", function(event) {
           event.preventDefault();
           console.log("new attribute added");

           const attributeGroup = document.createElement("div");
           attributeGroup.classList.add("d-flex");

           attributeGroup.innerHTML = `
           <div class="form-group">
               <label>{{ __('translate.attribute-name') }}</label>
               <input type="text" class="form-control" name="attribute_name[]">
           </div>
           <div class="form-group w-100 mx-4">
               <label>{{ __('translate.attribute-value') }} </label>
               <textarea class="form-control inputtags" name="attribute_values[]"></textarea>
           </div>
       `;

           // Append the new group to the container
           document.getElementById("attributes-container-group").appendChild(attributeGroup);

           // Reinitialize tagsinput for the newly added textarea
           $(attributeGroup).find(".inputtags").tagsinput();
       });
   </script>



   <script>
       document.getElementById("generate-variations").addEventListener("click", function(event) {
           event.preventDefault();
           const allVariationsContainer = document.getElementById("all-variation");
           allVariationsContainer.innerHTML = ""; // Clear previous variations

           // Get all attribute names and values
           const attributeNames = Array.from(document.querySelectorAll('input[name="attribute_name[]"]')).map(
               input => input.value.trim()
           );
           const attributeValues = Array.from(document.querySelectorAll('textarea[name="attribute_values[]"]'))
               .map(
                   input => input.value.trim()
               );

           // Validate that both names and values are filled
           if (attributeNames.includes("") || attributeValues.includes("")) {
               alert("Please provide both attribute names and values.");
               return;
           }

           // Split values by commas and prepare combinations
           const attributeCombinations = attributeValues.map(values => values.split(",").map(value => value
               .trim()));

           // Helper function to generate all combinations
           function generateCombinations(arrays) {
               const result = [];
               const helper = (prefix, remainingArrays) => {
                   if (remainingArrays.length === 0) {
                       result.push(prefix);
                       return;
                   }
                   remainingArrays[0].forEach(value => {
                       helper([...prefix, value], remainingArrays.slice(1));
                   });
               };
               helper([], arrays);
               return result;
           }

           // Generate all combinations of attributes
           const allCombinations = generateCombinations(attributeCombinations);

           // Display each combination as a variation
           allCombinations.forEach(combination => {
               const variationHTML = `
           <div class="variation-item bg-white p-3 mb-3">
               <p class="text-dark"><strong>Variation:</strong> ${combination.join(" | ")}</p>
               <div class="d-flex justify-content-between align-items-center">
                   <label for="image" class="text-dark">
                       <i class="fas fa-images fs-1"></i>
                       <input id="image" class="d-none" name="image_variant[]" type="file" class="form-control mb-2">
                   </label>
                   <div>
                       <label class="text-dark">{{ __('Price') }}</label>
                       <input type="number" class="form-control mb-2" name="price_variant[]" placeholder="Enter price">
                   </div>
                  
                   <button class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></button>
               </div>
           </div>
       `;
               allVariationsContainer.innerHTML += variationHTML;
           });

           // Add event listeners to delete buttons for each variation
           document.querySelectorAll(".delete-btn").forEach(button => {
               button.addEventListener("click", function() {
                   const variationDiv = button.closest(".variation-item");
                   variationDiv.remove();
               });
           });
       });
   </script>
