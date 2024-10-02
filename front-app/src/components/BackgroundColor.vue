<template>
    <div class="backgroundStyle">
        <svg viewBox="0 0 2280 1400" preserveAspectRatio="xMidYMid slice" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <!-- Definición de gradientes -->
            <defs>
                <!-- Gradiente para todo el fondo -->
                <linearGradient id="backgroundGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:var(--bg-background-1); stop-opacity:1" />
                    <stop offset="100%" style="stop-color:var(--bg-background-2); stop-opacity:1" />
                </linearGradient>

                <!-- Gradiente para el path negro -->
                <linearGradient id="blackGradient" x1="0%" y1="100%" x2="0%" y2="0%">
                    <stop offset="0%" style="stop-color:var(--bg-background-2); stop-opacity:1" />
                    <stop offset="100%" style="stop-color:var(--bg-background-1); stop-opacity:1" />
                </linearGradient>

                <!-- Gradiente para el área no pintada -->
                <linearGradient id="areaGradient" x1="100%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:var(--bg-background-1); stop-opacity:1" />
                    <stop offset="100%" style="stop-color:var(--bg-background-2); stop-opacity:1" />
                </linearGradient>
            </defs>

            <!-- Fondo con gradiente -->
            <rect x="0" y="0" width="2280" height="1400" fill="url(#backgroundGradient)" /> 

            <!-- Sección superior con gradiente de verde a amarillo -->
            <path d="M0,0 
                    L550,0 
                    C570,90 200,400 200,900 
                    S750,1000 2285,263 
                    L2285,0 
                    Z" fill="url(#blackGradient)" />

            <!-- Primera línea con degradado -->
            <path d="M2280,1400 
                    L2278,351 
                    C2200,400 1800,600 1900,1000 
                    S1500,1300 992,1400" 
                fill="url(#areaGradient)" />
        </svg>
    </div>
</template>

<style scoped>
.backgroundStyle {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: -1;
    overflow: hidden;
}
</style>
