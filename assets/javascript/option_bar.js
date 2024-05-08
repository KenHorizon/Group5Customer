var custom_select, i, j, custom_select_size, selectElement_size, selectElement, a, b, c;
/*look for any elements with the class "custom-select":*/
custom_select = document.getElementsByClassName("custom-select");
custom_select_size = custom_select.length;
for (i = 0; i < custom_select_size; i++) {
  selectElement = custom_select[i].getElementsByTagName("select")[0];
  selectElement_size = selectElement.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selectElement.options[selectElement.selectedIndex].innerHTML;
  custom_select[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selectElement_size; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selectElement.options[j].innerHTML;
    c.addEventListener("click", function(element) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var select_selected, i, k, parentNode_select, previous_sibling, parentNode_select_size, select_selected_size;
        parentNode_select = this.parentNode.parentNode.getElementsByTagName("select")[0];
        parentNode_select_size = parentNode_select.length;
        previous_sibling = this.parentNode.previousSibling;
        for (i = 0; i < parentNode_select_size; i++) {
          if (parentNode_select.options[i].innerHTML == this.innerHTML) {
            parentNode_select.selectedIndex = i;
            previous_sibling.innerHTML = this.innerHTML;
            select_selected = this.parentNode.getElementsByClassName("same-as-selected");
            select_selected_size = select_selected.length;
            for (k = 0; k < select_selected_size; k++) {
              select_selected[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        previous_sibling.click();
    });
    b.appendChild(c);
  }
  custom_select[i].appendChild(b);
  a.addEventListener("click", function(element) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      element.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(element) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var custom_select, select_selected, i, custom_select_size, select_selected_size, arrayNumbers = [];
  custom_select = document.getElementsByClassName("select-items");
  select_selected = document.getElementsByClassName("select-selected");
  custom_select_size = custom_select.length;
  select_selected_size = select_selected.length;
  for (i = 0; i < select_selected_size; i++) {
    if (element == select_selected[i]) {
      arrayNumbers.push(i)
    } else {
      select_selected[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < custom_select_size; i++) {
    if (arrayNumbers.indexOf(i)) {
      custom_select[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);