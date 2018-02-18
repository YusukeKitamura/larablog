<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <span>本文（必須）</span><br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <textarea placeholder="" name="body" cols="54" rows="20" :value="input_text" @input="update" style="height:360px;"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <span>プレビュー</span><br>
                <div class="panel panel-default prev-form">
                    <div class="panel-body">
                        <div v-html="compiledMarkdown"></div>
                    </div>
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
                return "<div v-pre>"+marked(this.input_text, { sanitize: true })+"</div>"
            }
        },
        methods: {
            update: _.debounce(function (e) {
                this.input_text = e.target.value
            }, 10)
        }
    }
</script>