<style>
    html, body {
    height: 100%;
    margin: 0;
}

.sidebar {
    height: 100vh; /* Full viewport height */
    position: fixed; /* Keep the sidebar fixed */
    top: 0;
    left: 0; /* Align to the left */
    width: 250px; /* Set a fixed width for your sidebar */
    background-color: #f8f9fa; /* Optional: set a background color */
    overflow-y: auto; /* Scroll if content overflows */
}

</style>
<nav id="sidebarMenu" class="sidebar">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <center>
                <li class="nav-item text-center mb-3">
                    <img src="logo/logo.jpg" alt="Avatar" class="avatar" width="100px" height="80px">
                    <h5 class="text-black">ADMINISTRADOR: <?php print $_SESSION["loginusuario"];?></h5>
                </li>
            </center>
            <hr>
            <li class="nav-item">
                <a class="nav-link active text-black" aria-current="page" href="Inicio">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house-door" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                    </svg>
                    Inicio
                </a>
            </li>
            <hr>

            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Veterinarios">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-heart" viewBox="0 0 16 16">
                        <path
                            d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
                    </svg>
                    Veterinarios
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Clientes">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275Z
                            <path
                                d=" M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7
                            12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24
                            1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0
                            4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5
                            3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042
                            1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4
                            13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275Z" />
                    </svg>
                    Clientes
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Mascotas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-gitlab" viewBox="0 0 16 16">
                        <path
                            d="m15.734 6.1-.022-.058L13.534.358a.57.57 0 0 0-.563-.356.6.6 0 0 0-.328.122.6.6 0 0 0-.193.294l-1.47 4.499H5.025l-1.47-4.5A.572.572 0 0 0 2.47.358L.289 6.04l-.022.057A4.044 4.044 0 0 0 1.61 10.77l.007.006.02.014 3.318 2.485 1.64 1.242 1 .755a.67.67 0 0 0 .814 0l1-.755 1.64-1.242 3.338-2.5.009-.007a4.05 4.05 0 0 0 1.34-4.668Z" />
                    </svg>
                    Mascotas
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Citas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-postcard-heart" viewBox="0 0 16 16">
                        <path
                            d="M8 4.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622M2.5 5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                        <path fill-rule="evenodd"
                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" />
                    </svg>
                    Citas
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Aprobadas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-card-checklist" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                        <path
                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0" />
                    </svg>
                    Aprobadas
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Consulta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-activity" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2" />
                    </svg>
                    Consulta
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Diagnostico">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-activity" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2" />
                    </svg>
                    Diagnostico
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link text-black" href="<?php echo URL; ?>Registro">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-postcard-heart" viewBox="0 0 16 16">
                        <path
                            d="M8 4.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622M2.5 5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                        <path fill-rule="evenodd"
                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" />
                    </svg>
                    Registro
                </a>
            </li>
            <hr>
            <li class="nav-item">
    <a class="nav-link text-black" href="#" onclick="openModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
        </svg>
        Cerrar Sesión
    </a>
</li>

        </ul>
    </div>
</nav>

<script src="path/to/sweetalert2.all.min.js"></script>
<script>
    function logout() {
        closeModal();
        Swal.fire({
            title: '¿Estás seguro que deseas cerrar sesión?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Cerrar Sesión'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir al archivo de cierre de sesión
                window.location.href = 'cerrar.php'; // Aquí rediriges a cerrar.php
            }
        });
    }
</script>
