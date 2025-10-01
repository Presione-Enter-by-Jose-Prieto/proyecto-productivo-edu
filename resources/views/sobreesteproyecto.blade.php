@extends('templates.html')

@section('title', 'Sobre este proyecto')

@push('styles')
<style>
    .contenedor {
        width: 90%;
        margin: 0 auto;
        padding: 30px 0;
    }
    .titulo {
        font-size: 1.7rem;
        font-weight: bold;
        color: #fff;
        text-align: center;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }
    .grid-sobre {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 24px;
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    .sobre-section {
        background: #161B23;
        border: 1px solid #2a2f38;
        border-radius: 8px;
        padding: 24px;
        color: #e6eefa;
        box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        font-size: 1.05rem;
        line-height: 1.7;
        box-sizing: border-box;
        min-width: 0;
    }
    .sobre-section ul {
        margin-left: 18px;
    }
    .sobre-section h2 {
        font-size: 1.2rem;
        color: #fff;
        margin-bottom: 10px;
    }
    @media (max-width: 1000px) {
        .grid-sobre {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (max-width: 700px) {
        .grid-sobre {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <x-header />
    <div class="contenedor">
        <h1 class="titulo">Sobre este proyecto</h1>
        <div class="grid-sobre">
            <div class="sobre-section">
                <h2>Propósito</h2>
                <p>
                    GESTUCOURSE surge para modernizar y agilizar la gestión educativa, permitiendo que estudiantes, docentes y administrativos accedan a una plataforma eficiente para la inscripción y administración de cursos de extensión. El propósito es fomentar la participación activa en actividades extracurriculares y fortalecer el desarrollo integral de la comunidad educativa.
                </p>
                <p>
                    La plataforma busca ser un puente entre la oferta institucional y los intereses de los estudiantes, promoviendo el acceso igualitario y la organización transparente de los cursos.
                </p>
            </div>
            <div class="sobre-section">
                <h2>Problema</h2>
                <p>
                    Los procesos tradicionales de inscripción suelen ser manuales, lentos y propensos a errores, lo que dificulta la gestión de cupos, la comunicación y el seguimiento de los participantes. Esto afecta la eficiencia administrativa y la satisfacción de los usuarios, generando demoras y pérdida de oportunidades para los estudiantes.
                </p>
                <p>
                    GESTUCOURSE resuelve estos inconvenientes al digitalizar y automatizar la preinscripción, eliminando barreras y mejorando la experiencia de todos los involucrados.
                </p>
            </div>
            <div class="sobre-section">
                <h2>Funcionalidad</h2>
                <p>
                    La plataforma permite:
                </p>
                <ul>
                    <li>Explorar la oferta de cursos de extensión disponibles.</li>
                    <li>Preinscribirse de manera rápida y sencilla desde cualquier dispositivo.</li>
                    <li>Recibir notificaciones sobre el estado de la inscripción y fechas importantes.</li>
                    <li>Administrar la información de los participantes y gestionar los cupos de cada curso.</li>
                </ul>
                <p>
                    Ejemplos de cursos gestionados: microfútbol, básquetbol, natación, voleibol, banda institucional, matemáticas, inglés, entre otros.
                </p>
            </div>
            <div class="sobre-section" style="grid-column: 1 / span 2;">
                <h2>Beneficios</h2>
                <ul>
                    <li>Optimización y automatización de procesos administrativos.</li>
                    <li>Acceso moderno, intuitivo y seguro para todos los usuarios.</li>
                    <li>Transparencia en la gestión de inscripciones y cupos.</li>
                    <li>Mejor comunicación entre estudiantes, docentes y organizadores.</li>
                    <li>Reducción de errores y demoras en el proceso de inscripción.</li>
                </ul>
                <p>
                    GESTUCOURSE contribuye a una gestión educativa más eficiente y participativa, adaptándose a las necesidades actuales de las instituciones.
                </p>
            </div>
            <div class="sobre-section" style="grid-column: 3 / span 1;">
                <h2>Contacto y agradecimientos</h2>
                <p>
                    Si tienes dudas, comentarios o sugerencias, puedes contactarnos a través de la sección de créditos. Tu opinión es fundamental para seguir mejorando la plataforma y ofrecer una mejor experiencia.
                </p>
                <p>
                    <strong>¡Gracias por confiar en GESTUCOURSE para tu formación y desarrollo!</strong>
                </p>
            </div>
        </div>
    </div>
@endsection
