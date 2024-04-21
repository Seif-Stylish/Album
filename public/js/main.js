var nonEmptyButton = Array.from(document.querySelectorAll(".nonEmptyButton"));

var dropDownDiv = Array.from(document.querySelectorAll(".dropDownDiv"));

for (var i = 0; i < nonEmptyButton.length; i++) {
    nonEmptyButton[i].addEventListener("click", displayDropdown)
}

function displayDropdown() {
    var index = nonEmptyButton.indexOf(this);

    $(dropDownDiv[index]).slideDown(300);
}
