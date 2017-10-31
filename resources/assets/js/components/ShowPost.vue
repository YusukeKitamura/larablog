<template>
    <div class="row">
         <div style="display:none;">
            <textarea placeholder="" name="body" cols="50" rows="10" :value="input_text" @input="update"></textarea>
        </div>
        <div class="col-md-11">
            <span style="font-weight:bold;">本文</span><br>
            <div class="panel panel-default" style="background-color:rgba( 255, 255, 255, 0.85 )">
                <div class="panel-body">
                    <div v-html="compiledMarkdown" v-once></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    marked.setOptions({
        highlight: function(code, lang) {
            return hljs.highlightAuto(code, [lang]).value;
        }
    });
    var body = $('#body-data').text();
    export default {
        data() {
            return {
                input_text : body
            }
        },
        computed: {
            compiledMarkdown: function () {
                return marked(this.input_text, { sanitize: true })
            }
        },
        methods: {
            update: _.debounce(function (e) {
                this.input_text = e.target.value
            }, 10)
        }
    }
</script>