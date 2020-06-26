<template>
    <div class="">
        <AdminNav></AdminNav>
        <router-view class="pb admin"></router-view>
        <footer class="footer mt">
            <div class="content has-text-centered ">
                <p>
                    <strong>LBDS</strong> by <em>Yann Grillon</em>. The source code is licensed.
                    The website content is licensed.
                    <br>
                    © Copyright
                </p>
            </div>
        </footer>
    </div>
</template>

<script>
    import AdminNav from "../../components/AdminNav";


    export default {
        name: "index",
        components: {
            AdminNav,

        },

    }
</script>

<style scoped lang="scss">
    footer {
        strong {
            color: #3ee28d!important;
        }
        color: #3ee28d!important;
        background: #2f2f2f!important;
    }
    .green:hover {
        color: #3CD07D !important;
    }



    .card {
        box-shadow: black 1px 1px 15px;
    }

    .center {
        justify-content: center;
    }
</style>
