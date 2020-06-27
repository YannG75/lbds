<template>
    <div class="daddy">
        <router-view :key="$route.path" class="view"></router-view>
    </div>
</template>

<script>

    export default {
        name: "App"
    }
</script>

<style lang="scss">
    @import "../../../../node_modules/bulma/sass/utilities/all";

    $carousel-arrow-color: #3cd07d;
    $carousel-indicator-color: #3cd07d;
    @import "../../../../node_modules/bulma";
    @import "../../../../node_modules/buefy/src/scss/buefy";

    .view {
        position: relative;
        min-height: 100vh;
        padding-bottom: 8.5rem;
        .global {
            .navbar-start {
                margin-left: auto;
                margin-right: unset;
            }
        }
    }

    .footer {
        bottom: 0;
        width: 100%;
        height: 2.5rem;
        clear: both;
        position: absolute;

    }

    ::-webkit-scrollbar {
        width: 10px;
        height: 5px;
    }



    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #3cd07d;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #41ffa7;
    }

    .ml-1 {
        margin-left: 5px !important;
    }

    .ml-2 {
        margin-left: 10px !important;
    }

    .ml-3 {
        margin-left: 15px !important;
    }

    .ml-4 {
        margin-left: 20px !important;
    }

    .ml-5 {
        margin-left: 25px !important;
    }

    .mr-1 {
        margin-right: 5px !important;
    }

    .mr-2 {
        margin-right: 10px !important;
    }

    .mr-3 {
        margin-right: 15px !important;
    }

    .mr-4 {
        margin-right: 20px !important;
    }

    .mr-5 {
        margin-right: 25px !important;
    }

    .mb {
        margin-bottom: 12px !important;
    }

    .mt {
        margin-top: 12px !important;
    }

    .m-auto {
        margin: auto;
    }

    .m-1 {
        margin: 5px !important;
    }

    .m-2 {
        margin: 10px !important;
    }

    .m-3 {
        margin: 15px !important;
    }

    .m-4 {
        margin: 20px !important;
    }

    .pl-1 {
        padding-left: 5px !important;
    }

    .pl-2 {
        padding-left: 10px !important;
    }

    .pl-3 {
        padding-left: 15px !important;
    }

    .pl-4 {
        padding-left: 20px !important;
    }

    .pr-1 {
        padding-right: 5px !important;
    }

    .pr-2 {
        padding-right: 10px !important;
    }

    .pr-3 {
        padding-right: 15px !important;
    }

    .pr-4 {
        padding-right: 20px !important;
    }

    .p-1 {
        padding: 5px !important;
    }

    .p-2 {
        padding: 10px !important;
    }

    .p-3 {
        padding: 15px !important;
    }

    .p-4 {
        padding: 20px !important;
    }

    .pb {
        padding-bottom: 12px !important;
    }

    .pb-5 {
        padding-bottom: 50px !important;
    }

    .pt {
        padding-top: 12px !important;
    }

    .top-title {
        position: absolute;
        top: 50px;
    }

    .absolute-top {
        top: 20px;
        left: 20px;
        color: aliceblue;
        font-size: 25px;
        text-shadow: #1b1e21 1px 1px 4px;
    }

    .bot-price {
        width: 30%;
        bottom: 50px;
        right: 15px;
        position: absolute;
    }

    .is-absolute {
        position: absolute;
    }

    .gridCenter {
        display: grid;
        grid-template-columns: repeat(2, 270px);
        grid-gap: 30px;
        grid-auto-rows: minmax(100px, auto);
        justify-content: center;
        padding: 100px 20px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, 335px);
        grid-gap: 50px;
        justify-content: center;
        grid-auto-rows: minmax(100px, auto);
        padding: 50px 20px;
    }

    .gridSize {
        display: grid;
        grid-template-columns: repeat(auto-fill, 28px);
        grid-gap: 25px;
        justify-content: center;
        grid-auto-rows: minmax(37px, auto);
        padding: 10px 20px;
    }

    .is-pointed {
        cursor: pointer;
    }

    .ellipsis {
        width: 100%;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .Hovered {
        background-color: rgba(75, 75, 75, 0.25);
        width: 100%;
        height: 100%;
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .index {
        z-index: 1;
    }

    .t-0 {
        top: 0;
    }

    .l-0 {
        left: 0;
    }

    .t-50 {
        top: 50%;
    }

    .l-50 {
        left: 50%;
    }

    .center {
        justify-content: center;
    }

    .is-pointed:hover {
        .Hovered {
            display: flex;
        }

    }


    @media all and (max-width: 768px) {

        .hero-body {
            height: 55vh !important;
        }
    }

    @media all and (max-width: 600px) {
        .gridCenter {

            grid-template-columns: repeat(auto-fill, 270px);

        }

        .hero-body {
            height: 40vh !important;

            .title {
                font-size: 1rem;
            }

            p {
                font-size: 0.85rem;
            }

        }


    }

    /*@media all and (max-width: 400px) {*/
    /*    .hero-body {*/
    /*        height: 35vh !important;*/
    /*    }*/

    /*}*/

</style>
