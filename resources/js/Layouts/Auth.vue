<template>
    <a-layout class="layout">
        <a-layout-content>
            <div class="container">
                <div class="container__inner">
                    <slot/>
                </div>
            </div>
        </a-layout-content>
    </a-layout>
</template>

<style scoped>
.layout {
    background: none;
}

.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 50px 0;
}

.container__inner {
    width: 500px;
}
</style>
