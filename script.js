document.addEventListener("DOMContentLoaded", () => {
  const revealElements = document.querySelectorAll(".reveal");
  const contactForm = document.getElementById("contactForm");
  const formMessage = document.getElementById("formMessage");
  const navLinks = document.querySelectorAll(".nav-link");
  const navbarCollapse = document.getElementById("mainNav");

  // Animación al hacer scroll
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    },
    { threshold: 0.14 }
  );

  revealElements.forEach((el) => observer.observe(el));

  // Cerrar menú móvil al dar click en un enlace
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth < 992 && navbarCollapse.classList.contains("show")) {
        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse)
          || new bootstrap.Collapse(navbarCollapse, { toggle: false });

        bsCollapse.hide();
      }
    });
  });

  // Formulario demostrativo
  if (contactForm) {
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();

      formMessage.textContent =
        "Gracias por tu mensaje. Este formulario es demostrativo dentro del mockup.";
      formMessage.style.color = "#344054";

      contactForm.reset();
    });
  }
});