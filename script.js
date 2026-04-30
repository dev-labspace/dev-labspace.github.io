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

  if (contactForm) {
    contactForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const submitButton = contactForm.querySelector('button[type="submit"]');
      const formData = new FormData(contactForm);

      formMessage.textContent = "";
      submitButton.disabled = true;
      submitButton.textContent = "Enviando...";

      try {
        const response = await fetch(contactForm.action, {
          method: "POST",
          body: formData,
        });

        const text = await response.text();
        console.log("Respuesta contacto.php:", text);

        let result;

        try {
          result = JSON.parse(text);
        } catch (error) {
          throw new Error("Respuesta no JSON: " + text);
        }

        if (result.success) {
          formMessage.textContent = result.message;
          formMessage.style.color = "#2f6f4e";
          contactForm.reset();
        } else {
          formMessage.textContent = result.message;
          formMessage.style.color = "#9b2c2c";
        }
      } catch (error) {
        formMessage.textContent = "Error de conexión.";
        formMessage.style.color = "#9b2c2c";
      } finally {
        submitButton.disabled = false;
        submitButton.textContent = "Enviar mensaje";
      }
    });
  }

  const startedAt = document.getElementById("formStartedAt");

  if (startedAt) {
    startedAt.value = Date.now().toString();
  }
});