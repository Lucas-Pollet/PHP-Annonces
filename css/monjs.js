var nbad = 1;
var lastid = 0;

function readURL(input) {
    if (input.files && input.files[0]) {
      if(nbad <= 5) {
          var reader = new FileReader();

          reader.onload = function (e) {
              var preview = document.getElementById("preview");

              var listItem = document.createElement("li");
              var button = document.createElement("button");

              var id_image = Math.random();
              listItem.innerHTML = "<img name='photo' id='"+ id_image +"' src='" + e.target.result + "' />";


              button.setAttribute("id", "butt"+id_image);
              button.setAttribute("class", "btn--danger");
              button.setAttribute("onclick", "removeUpload("+id_image+")");
              button.setAttribute("type", "button");
              button.innerHTML = "Supprimer l'image";

              var add_button = document.createElement("input");
              add_button.setAttribute("class", "btn--info pad-butt");
              add_button.setAttribute("type", "button");
              add_button.setAttribute("id", "add"+id_image);
              add_button.setAttribute("onclick", "document.getElementById('photo"+id_image+"').click()");
              add_button.setAttribute("value", "Ajouter une image");

              var input_file = document.createElement("input");
              input_file.setAttribute("name", "photo"+id_image);
              input_file.setAttribute("id", "photo"+id_image);
              input_file.setAttribute("type", "file");
              input_file.setAttribute("onchange", "readURL(this)");
              input_file.setAttribute("accept", "image/*");
              input_file.style.display = 'none';

              preview.append(listItem);
              preview.append(button);
              preview.append(add_button);
              preview.append(input_file);



              if(nbad <= 1){
                  document.getElementById("addphoto").style.display = "none";
              }
              if(lastid != 0){
                  document.getElementById("add"+lastid).style.display = "none";
              }
              lastid = id_image;

              nbad = nbad + 1;
          };

          reader.readAsDataURL(input.files[0]);

      }else{
          alert("5 photos maximum !");
      }
    }
}

function removeUpload(id) {
    document.getElementById(id).remove();

    document.getElementById("butt"+id).remove();
    document.getElementById("photo"+id).value = "";
    nbad = nbad -1;

    document.getElementById("add"+lastid).style.display = "block";

    if(nbad <=1) {
        document.getElementById("addphoto").style.display = "block";
        document.getElementById("add"+lastid).style.display = "none";
    }

}