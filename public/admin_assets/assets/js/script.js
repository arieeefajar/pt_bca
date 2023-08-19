console.log("JavaScript terpanggil!");

let tags = [];

function remove(element, tag){
    let index  = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();
    console.log(tags)
}

document.addEventListener("DOMContentLoaded", function() {
    const inputTags = document.getElementById('inputTags');
    const ul = document.getElementById("tagList");

    function addTag(e, id) {
        console.log(id);
        if(e.key == " "){
        let tag = e.target.value.replace(/\s+/g, ' ');
        if (tag.length > 1 && !tags.includes(tag)) {
            tag.split(',').forEach(tag =>{
                tags.push(tag);
                createTag();
            });
        }
        e.target.value = "";
        }
    }

    inputTags.addEventListener("keyup", addTag);

    function createTag(){
        ul.querySelectorAll("li").forEach(li => li.remove());
        tags.slice().reverse().forEach(tag =>{
            let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
            ul.insertAdjacentHTML("afterbegin", liTag);
        });
    }
});
