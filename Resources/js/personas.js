const personas = document.querySelectorAll(".persona");

personas.forEach(persona =>{
    persona.addEventListener("click", () => {
        persona.classList.toggle("active");
    })
})