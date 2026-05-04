<?php require __DIR__ . '/include/cache-version.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Myriam Benavides | Psicoterapia y Psicodiagnóstico</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css?v=<?= asset_version('css/style.css'); ?>" />
</head>

<body>
    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a href="#inicio" class="navbar-brand brand">
                    <small data-i18n="brand_small">Psicoterapia y Psicodiagnóstico</small>
                    <strong>Lic. Myriam Benavides</strong>
                </a>

                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir menú">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse justify-content-lg-end" id="mainNav">
                    <ul class="navbar-nav nav-links">
                        <li class="nav-item"><a class="nav-link" href="#inicio" data-i18n="nav_home">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#perfil" data-i18n="nav_profile">Perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#areas" data-i18n="nav_areas">Áreas de atención</a></li>
                        <li class="nav-item"><a class="nav-link" href="#trayectoria" data-i18n="nav_journey">Trayectoria</a></li>
                        <li class="nav-item"><a class="nav-link" href="#credenciales" data-i18n="nav_credentials">Credenciales</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contacto" data-i18n="nav_contact">Contacto</a></li>
                    </ul>

                    <div class="language-switch ms-lg-3 mt-3 mt-lg-0">
                        <button type="button" class="lang-btn active" data-lang="es">ES</button>
                        <span>/</span>
                        <button type="button" class="lang-btn" data-lang="en">EN</button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section section-hero" id="inicio">
            <div class="container">
                <div class="row hero-row g-4 hero-full">
                    <div class="col-lg-6">
                        <div class="hero-text reveal">
                            <h1 data-i18n="hero_title">Atención psicológica con experiencia, seriedad clínica y trato humano.</h1>

                            <p class="hero-description" data-i18n="hero_description">
                                La consulta privada integra formación especializada y amplia experiencia
                                en psicoterapia, evaluación psicológica y psicodiagnóstico.
                            </p>

                            <div class="actions">
                                <a href="#contacto" class="btn custom-btn btn-primary-custom" data-i18n="hero_primary">Solicitar información</a>
                                <a href="#perfil" class="btn custom-btn btn-secondary-custom" data-i18n="hero_secondary">Conocer perfil</a>
                            </div>

                            <div class="stats-showcase reveal">
                                <div class="stats-top-row">
                                    <article class="custom-card stat-card stat-card-compact">
                                        <strong data-i18n="stat_udem_title">UDEM</strong>
                                        <span data-i18n="stat_udem_subtitle">Licenciatura en Psicología</span>
                                        <p data-i18n="stat_udem_text">Formación profesional universitaria.</p>
                                    </article>

                                    <article class="custom-card stat-card stat-card-featured">
                                        <strong data-i18n="stat_uanl_title">UANL</strong>
                                        <span data-i18n="stat_uanl_subtitle">Depto. de Psiquiatría</span>
                                        <p data-i18n="stat_uanl_text">
                                            Especialidad y Subespecialidad en Psicoterapia de adultos,
                                            adolescentes y niños.
                                        </p>
                                    </article>
                                </div>

                                <article class="custom-card stat-card stat-card-wide">
                                    <strong data-i18n="stat_years_title">40+</strong>
                                    <div>
                                        <span data-i18n="stat_years_subtitle">Años de experiencia</span>
                                        <p data-i18n="stat_years_text">Trayectoria clínica, docente y de consulta privada.</p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 hero-image-col">
                        <div class="hero-image-wrap reveal">
                            <img src="img/hero.jpg" alt="Espacio de consulta psicológica" class="hero-image">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding section-plain" id="perfil">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-5">
                        <div class="profile-photo-block reveal">
                            <img src="img/alicia-miriam-benavides.jpg" alt="Alicia Miriam Benavides Scott"
                                class="profile-photo">
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="reveal">
                            <span class="eyebrow" data-i18n="profile_eyebrow">Perfil profesional</span>
                            <h2 data-i18n="profile_title">Una trayectoria dedicada a la atención clínica, la docencia y el psicodiagnóstico.</h2>
                            <p data-i18n="profile_text_1">
                                Egresada de la Universidad de Monterrey, Alicia Miriam Benavides Scott desarrolló su
                                formación de posgrado (1978-2013) en el Departamento de Psiquiatría del Hospital
                                Universitario de la UANL, donde también ejerció labores docentes y de coordinación.
                            </p>
                            <p data-i18n="profile_text_2">
                                Su práctica integra experiencia clínica, formación especializada en psicoterapia de
                                adultos, adolescentes y niños, y un profundo interés por el psicodiagnóstico como
                                herramienta de evaluación precisa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding section-surface" id="trayectoria">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="reveal">
                            <span class="eyebrow" data-i18n="journey_eyebrow">Trayectoria</span>
                            <h2 data-i18n="journey_title">Formación, docencia y práctica clínica en un recorrido profesional de gran solidez.</h2>
                            <p data-i18n="journey_text">
                                Una trayectoria construida entre la universidad, el hospital, la enseñanza y la consulta.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="timeline-list">
                            <article class="card custom-card timeline-item reveal">
                                <div class="timeline-row">
                                    <div class="timeline-year-wrap">
                                        <span class="timeline-year">1975</span>
                                    </div>
                                    <div>
                                        <h3 data-i18n="timeline_1975_title">Licenciatura en Psicología</h3>
                                        <p data-i18n="timeline_1975_text">
                                            Graduada por la Universidad de Monterrey y reconocida ese año como una de
                                            las Mejores Estudiantes de México.
                                        </p>
                                    </div>
                                </div>
                            </article>

                            <article class="card custom-card timeline-item reveal">
                                <div class="timeline-row">
                                    <div class="timeline-year-wrap">
                                        <span class="timeline-year">1978–1981</span>
                                    </div>
                                    <div>
                                        <h3 data-i18n="timeline_1978_title">Residencia en Psiquiatría Hospitalaria y de la Comunidad</h3>
                                        <p data-i18n="timeline_1978_text">
                                            Integró la primera generación de esta especialidad en el Hospital
                                            Universitario de la UANL.
                                        </p>
                                    </div>
                                </div>
                            </article>

                            <article class="card custom-card timeline-item reveal">
                                <div class="timeline-row">
                                    <div class="timeline-year-wrap">
                                        <span class="timeline-year">1983–1985</span>
                                    </div>
                                    <div>
                                        <h3 data-i18n="timeline_1983_title">Subespecialidad en Psicoterapia de Niños y Adolescentes</h3>
                                        <p data-i18n="timeline_1983_text">
                                            Formó parte de la primera generación de esta subespecialidad en el mismo
                                            Departamento de Psiquiatría.
                                        </p>
                                    </div>
                                </div>
                            </article>

                            <article class="card custom-card timeline-item reveal">
                                <div class="timeline-row">
                                    <div class="timeline-year-wrap">
                                        <span class="timeline-year" data-i18n="timeline_teaching_year">Trayectoria docente</span>
                                    </div>
                                    <div>
                                        <h3 data-i18n="timeline_teaching_title">Maestra, supervisora y coordinadora de la especialidad</h3>
                                        <p data-i18n="timeline_teaching_text">
                                            Desarrolló una amplia labor académica y de supervisión clínica, junto con su
                                            práctica privada.
                                        </p>
                                    </div>
                                </div>
                            </article>

                            <article class="card custom-card timeline-item reveal">
                                <div class="timeline-row">
                                    <div class="timeline-year-wrap">
                                        <span class="timeline-year" data-i18n="timeline_today_year">Actualidad</span>
                                    </div>
                                    <div>
                                        <h3 data-i18n="timeline_today_title">Consulta privada</h3>
                                        <p data-i18n="timeline_today_text">
                                            Actualmente se dedica de tiempo completo a la Consulta Privada, tras su
                                            trayectoria como docente por más de 30 años en el departamento de
                                            Psiquiatría de la UANL.
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding section-plain" id="credenciales">
            <div class="container">
                <div class="section-heading reveal diploma-heading">
                    <span class="eyebrow" data-i18n="credentials_eyebrow">Credenciales y formación complementaria</span>
                    <h2 data-i18n="credentials_title">Documentos académicos y profesionales que respaldan su trayectoria.</h2>
                    <p data-i18n="credentials_text">
                        Consulta una selección de títulos, constancias, reconocimientos y acreditaciones profesionales.
                    </p>
                </div>

                <div class="row g-4 diploma-grid">
                    <div class="col-md-6 col-xl-4">
                        <article class="card custom-card diploma-card reveal h-100">
                            <div class="diploma-card-body">
                                <span class="diploma-tag" data-i18n="credential_1_tag">Título profesional</span>
                                <h3 data-i18n="credential_1_title">Licenciatura en Psicología</h3>
                                <p data-i18n="credential_1_text">Universidad de Monterrey · 24 de noviembre de 1975.</p>
                            </div>
                            <a href="docs/titulo-licenciatura-udem.pdf" target="_blank" rel="noopener"
                                class="btn diploma-link" data-i18n="view_document">
                                Ver documento
                            </a>
                        </article>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <article class="card custom-card diploma-card reveal h-100">
                            <div class="diploma-card-body">
                                <span class="diploma-tag" data-i18n="credential_2_tag">Reconocimiento</span>
                                <h3 data-i18n="credential_2_title">Los Mejores Estudiantes de México</h3>
                                <p data-i18n="credential_2_text">Reconocimiento otorgado en 1975 por su desempeño académico.</p>
                            </div>
                            <a href="docs/reconocimiento-mejor-estudiante-1975.pdf" target="_blank" rel="noopener"
                                class="btn diploma-link" data-i18n="view_recognition">
                                Ver reconocimiento
                            </a>
                        </article>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <article class="card custom-card diploma-card reveal h-100">
                            <div class="diploma-card-body">
                                <span class="diploma-tag" data-i18n="credential_3_tag">Constancia</span>
                                <h3 data-i18n="credential_3_title">Psiquiatría Hospitalaria y de la Comunidad</h3>
                                <p data-i18n="credential_3_text">Facultad de Medicina UANL · Entrenamiento de especialidad de 1978 a 1981.</p>
                            </div>
                            <a href="docs/constancia-psiquiatria-hospitalaria.pdf" target="_blank" rel="noopener"
                                class="btn diploma-link" data-i18n="view_certificate">
                                Ver constancia
                            </a>
                        </article>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <article class="card custom-card diploma-card reveal h-100">
                            <div class="diploma-card-body">
                                <span class="diploma-tag" data-i18n="credential_4_tag">Diploma</span>
                                <h3 data-i18n="credential_4_title">Psicología Clínica Infantil</h3>
                                <p data-i18n="credential_4_text">Curso tutelar teórico-clínico · Facultad de Medicina UANL · 1983–1985.</p>
                            </div>
                            <a href="docs/diploma-psicologia-clinica-infantil.pdf" target="_blank" rel="noopener"
                                class="btn diploma-link" data-i18n="view_diploma">
                                Ver diploma
                            </a>
                        </article>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <article class="card custom-card diploma-card reveal h-100">
                            <div class="diploma-card-body">
                                <span class="diploma-tag" data-i18n="credential_5_tag">Cédula profesional</span>
                                <h3 data-i18n="credential_5_title">Especialidad registrada</h3>
                                <p data-i18n="credential_5_text">Cédula profesional de especialidad No. 5524609.</p>
                            </div>
                            <a href="docs/cedula-especialidad-5524609.pdf" target="_blank" rel="noopener"
                                class="btn diploma-link" data-i18n="view_license">
                                Ver cédula
                            </a>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding section-soft" id="areas">
            <div class="container">
                <div class="section-heading reveal">
                    <span class="eyebrow" data-i18n="areas_eyebrow">Áreas de atención</span>
                    <h2 data-i18n="areas_title">Práctica clínica respaldada por experiencia profesional y formación especializada.</h2>
                </div>

                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <article class="card custom-card feature-card reveal h-100">
                            <div class="feature-icon">
                                <i class="fa-solid fa-couch"></i>
                            </div>
                            <h3 data-i18n="area_1_title">Psicoterapia</h3>
                            <p data-i18n="area_1_text">Atención clínica con experiencia en procesos terapéuticos de adultos, niños y adolescentes.</p>
                        </article>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <article class="card custom-card feature-card reveal h-100">
                            <div class="feature-icon">
                                <i class="fa-solid fa-book-medical"></i>
                            </div>
                            <h3 data-i18n="area_2_title">Psicodiagnóstico</h3>
                            <p data-i18n="area_2_text">Evaluación psicológica basada en pruebas especializadas y criterios clínicos precisos.</p>
                        </article>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <article class="card custom-card feature-card reveal h-100">
                            <div class="feature-icon">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <h3 data-i18n="area_3_title">Docencia clínica</h3>
                            <p data-i18n="area_3_text">Experiencia como maestra, supervisora y coordinadora en el Departamento de Psiquiatría de la UANL.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding cta-section">
            <div class="container">
                <div class="card cta-wrap reveal">
                    <div>
                        <span class="eyebrow" data-i18n="cta_eyebrow">Contacto</span>
                        <h2 data-i18n="cta_title">Un espacio de atención profesional, cercano y confiable.</h2>
                        <p data-i18n="cta_text">
                            Si deseas solicitar información o agendar una primera consulta, puedes utilizar el
                            formulario o escribir directamente por correo electrónico.
                        </p>
                    </div>

                    <div class="cta-action">
                        <a href="#contacto" class="btn cta-btn" data-i18n="cta_button">Solicitar información</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding section-contact" id="contacto">
            <div class="container">
                <div class="row g-4 align-items-start contact-layout">
                    <div class="col-lg-4">
                        <div class="reveal contact-intro">
                            <span class="eyebrow" data-i18n="contact_eyebrow">Contacto</span>
                            <h2 data-i18n="contact_title">Solicita información</h2>
                            <p data-i18n="contact_text">
                                También puedes comunicarte por teléfono o correo electrónico.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <article class="card custom-card contact-card reveal">
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="mock-form">
                                        <span class="eyebrow" data-i18n="form_eyebrow">Formulario de contacto</span>

                                        <form id="contactForm" action="include/contacto.php" method="POST" novalidate>
                                            <input type="text" name="website" class="hp-field" tabindex="-1" autocomplete="off" />
                                            <input type="hidden" name="form_started_at" id="formStartedAt" />
                                            <input type="hidden" name="idioma" id="formLanguage" value="es" />

                                            <input class="form-field" type="text" name="nombre"
                                                placeholder="Nombre completo" data-i18n-placeholder="form_name" />

                                            <input class="form-field" type="email" name="correo"
                                                placeholder="Correo electrónico" data-i18n-placeholder="form_email" />

                                            <input class="form-field" type="tel" name="telefono"
                                                placeholder="Teléfono" data-i18n-placeholder="form_phone" />

                                            <textarea class="form-field" name="motivo"
                                                placeholder="Motivo de contacto" data-i18n-placeholder="form_reason"></textarea>

                                            <button class="btn custom-btn btn-primary-custom w-100 mt-3" type="submit"
                                                data-i18n="form_submit">
                                                Enviar mensaje
                                            </button>

                                            <p id="formMessage" class="form-message"></p>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="contact-info-block contact-info-grid contact-info-grid-compact">
                                        <div class="contact-item">
                                            <span class="contact-symbol">
                                                <i class="fa-solid fa-phone"></i>
                                            </span>
                                            <div>
                                                <strong data-i18n="phone">Teléfono</strong>
                                                <p>
                                                    <a href="tel:+528183094221" class="contact-link">
                                                        +52 (81) 8309-4221
                                                    </a>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="contact-item">
                                            <span class="contact-symbol">
                                                <i class="fa-solid fa-envelope"></i>
                                            </span>
                                            <div>
                                                <strong data-i18n="email">Correo electrónico</strong>
                                                <p>
                                                    <a href="mailto:contacto@myriambenavides.com.mx" class="contact-link">
                                                        contacto@myriambenavides.com.mx
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-brand-block">
                    <a href="#inicio" class="footer-brand">
                        <small data-i18n="footer_small">Psicología clínica</small>
                        <strong>Myriam Benavides</strong>
                    </a>

                    <p class="footer-description" data-i18n="footer_description">
                        Consulta privada con trayectoria clínica, formación especializada y experiencia en psicoterapia
                        y psicodiagnóstico en Monterrey, Nuevo León.
                    </p>
                </div>

                <div class="footer-column">
                    <span class="footer-title" data-i18n="footer_nav">Navegación</span>
                    <ul class="footer-links">
                        <li><a href="#inicio" data-i18n="nav_home">Inicio</a></li>
                        <li><a href="#perfil" data-i18n="nav_profile">Perfil</a></li>
                        <li><a href="#areas" data-i18n="nav_areas">Áreas de atención</a></li>
                        <li><a href="#trayectoria" data-i18n="nav_journey">Trayectoria</a></li>
                        <li><a href="#credenciales" data-i18n="nav_credentials">Credenciales</a></li>
                        <li><a href="#contacto" data-i18n="nav_contact">Contacto</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <span class="footer-title" data-i18n="footer_contact">Contacto</span>
                    <ul class="footer-contact-list">
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <span class="footer-contact-text">
                                <a href="tel:+528183094221">+52 (81) 8309-4221</a>
                            </span>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <span class="footer-contact-text">
                                <a href="mailto:contacto@myriambenavides.com.mx">contacto@myriambenavides.com.mx</a>
                            </span>
                        </li>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <span class="footer-contact-text">Monterrey, Nuevo León, México</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span data-i18n="footer_bottom">Psicología clínica y psicodiagnóstico.</span>

                <span>
                    <span data-i18n="footer_credit">Alicia Miriam Benavides Scott · Consulta privada</span>
                    <span class="footer-credit">
                        · <span data-i18n="image_credit">Imagen por</span>
                        <a href="https://magnific.com" target="_blank" rel="noopener">
                            Magnific
                        </a>
                    </span>
                </span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/translations.js?v=<?= asset_version('js/translations.js'); ?>"></script>
    <script src="js/script.js?v=<?= asset_version('js/script.js'); ?>"></script>
</body>
</html>