//Get all of the buttons equal to data attribute. No worry overlap between CSS classes and JS 
//loop thorugh buttons and add event listener that will swap to the next image
const buttons = document.querySelectorAll("[data-carousel-button]")
//
console.log(buttons)
//set buttons 
buttons.forEach(button => {
  button.addEventListener("click", () => {
    //accessing property we set in html
    //we will go to next img or previous one
    const offset = button.getAttribute("data-carousel-Button") === "next" ? 1 : -1
    //Going from button to slider to selecting the first slide
    //
    console.log(offset)
    const slides = button.closest("[data-carousel]").querySelector("[data-slides]")
    //
    console.log(slides)
    //get active slides
    const activeSlide = slides.querySelector("[data-active]")
    console.log(activeSlide)
    //get new index
    //convert sliders childeren to array
    let newIndex = [...slides.children].indexOf(activeSlide) + offset
    //if we go backwards past out first image we change the index to the last image
    console.log(newIndex)
    console.log(slides.children.length)
    if (newIndex < 0) newIndex = slides.children.length - 1
    //if we past the last slide we start the index over
    if (newIndex >= slides.children.length) newIndex = 0
    console.log(newIndex)
    //adding data-active attribute to the currenlty active index
    slides.children[newIndex].dataset.active = true
    delete activeSlide.dataset.active
    //removes data-active attribute from the previously active index
  })

})