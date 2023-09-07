console.log("JavaScript terpanggil!");

function submit_form(myForm) {
    try {
        var form = document.getElementById("myForm");
        var inputs = form.querySelectorAll("input, select, textarea");
        var isValid = true;

        inputs.forEach(function (input) {
            if (input.required && input.value.trim() === "") {
                isValid = false;
                input.classList.add("is-invalid");
            } else {
                input.classList.remove("is-invalid");
            }
        });

        if (form) {
            if (isValid) {
                form.submit();
            }
        } else {
            console.log("Form element not found.");
        }
    } catch (error) {
        console.log("Error:", error);
    }
}

// let tags = [];

// function remove(element, tag) {
//     let index = tags.indexOf(tag);
//     tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
//     element.parentElement.remove();
//     console.log(tags);
// }

// document.addEventListener("DOMContentLoaded", function () {
//     const inputTags = document.getElementById("inputTags");
//     const ul = document.getElementById("tagList");

//     function addTag(e, id) {
//         console.log(id);
//         if (e.key == " ") {
//             let tag = e.target.value.replace(/\s+/g, " ");
//             if (tag.length > 1 && !tags.includes(tag)) {
//                 tag.split(",").forEach((tag) => {
//                     tags.push(tag);
//                     createTag();
//                 });
//             }
//             e.target.value = "";
//         }
//     }

//     inputTags.addEventListener("keyup", addTag);

//     function createTag() {
//         ul.querySelectorAll("li").forEach((li) => li.remove());
//         tags.slice()
//             .reverse()
//             .forEach((tag) => {
//                 let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
//                 ul.insertAdjacentHTML("afterbegin", liTag);
//             });
//     }
// });
