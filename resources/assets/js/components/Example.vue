<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                       <h3>
                           {{ message }}
                       </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                message : 'Hello from Example component!!!'
            }
        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
