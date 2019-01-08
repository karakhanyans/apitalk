<template>
    <div class="container">
        <app-header></app-header>
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Header from './components/layout/Header'

    export default {
        components: {
            appHeader: Header
        }
    }
</script>
