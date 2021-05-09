/**
 * Controls mode selection animation in Generator page.
 * @param btnNode Clicked DOM button object, i.e. the mode selected.
 */
function selectMode(btnNode)
{
  // Expand button to full width of screen and "remove" hover effect.
  // By "remove," make hover effect permanent.
  btnNode.style.zIndex = 2;
  btnNode.style.width = "100%";
  btnNode.querySelector("img").style.transform = "scale(1.1,1.1)";

  // Disable mode buttons.
  var imgs = document.querySelectorAll(".modeBtn");
  imgs[0].style.pointerEvents = "none";
  imgs[1].style.pointerEvents = "none";
  
  // Slide up (and show) corresponding form after button expansion animation is complete.
  var formContainer = document.getElementById(btnNode.id + "Form");
  formContainer.style.display = "block";
  setTimeout(function() {
    formContainer.style.transform = "none";
  }, 750);
}

/**
 * TODO: GENERATE MAZE.
 */
function generateMaze(btnNode)
{
  btnNode.nextElementSibling.style.display = "inline-block";
  btnNode.nextElementSibling.nextElementSibling.style.display = "inline-block";
  btnNode.nextElementSibling.nextElementSibling.nextElementSibling.style.display = "inline-block";
  btnNode.style.display = "none";
}

/**
 * When user selects a story from table of pre-existing stories, show/hide appropriate elements and tag selected story.
 * @param selectedNode element to be tagged as selected.
 */
function selectStory(selectedNode)
{
  // Tag selected story (table row) as selected for when maze is to be generated.
  selectedNode.classList.add("selectedStory");

  // Hide all table rows (i.e. stories) except table header (i.e. title, author, uploader) and selected story table row.
  var notSelectedNodes = document.getElementById("stories").querySelectorAll("tr:not(:nth-of-type(1)):not(.selectedStory)");
  for (var i = 0; i < notSelectedNodes.length; i++)
  {
    notSelectedNodes[i].style.display = "none";
  }

  // Hide all elements that should be hidden when story is selected, except other stories as they are already hidden above.
  var elementsToHide = document.querySelectorAll(".hideWhenSelected");
  for (var i = 0; i < elementsToHide.length; i++)
  {
    elementsToHide[i].style.display = "none";
  }

  // Show all elements that should be shown when story is selected.
  document.querySelectorAll(".showWhenSelected").forEach(element => {
    if (element.tagName == "TD")
    {
      // Element to be shown is a table cell, i.e. requires special display.
      element.style.display = "table-cell";
    } else
    {
      // Element not a table-cell, so no special display needed.
      element.style.display = "block";
    }
  });
}

/**
 * If user unselects a story, revert to initial form view with table of pre-existing stories, and untag selected story.
 */
function unselectStory()
{
  // Untag selected story (table row).
  document.querySelector(".selectedStory").classList.remove("selectedStory");

  // Hide all elements that were shown when story was selected.
  var elementsToHide = document.querySelectorAll(".showWhenSelected");
  for (var i = 0; i < elementsToHide.length; i++)
  {
    elementsToHide[i].style.display = "none";
  }

  // Show stories (table rows) that were not selected.
  var tableRows = document.getElementById("stories").querySelectorAll("tr");
  for (var i = 0; i < tableRows.length; i++)
  {
    tableRows[i].style.display = "table-row";
  }

  // Show all elements that were hidden when story was selected, except other stories as they are already shown above.
  document.querySelectorAll(".hideWhenSelected").forEach(element => {
    if (element.tagName == "TD")
    {
      // Element to be shown is a table cell, i.e. requires special display.
      element.style.display = "table-cell";
    } else
    {
      // Element not a table cell, so no special display needed.
      element.style.display = "block";
    }
  });
}