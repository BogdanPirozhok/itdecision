<template>
    <v-container
        fluid
        tag="section"
    >
        <titlealert
            :active="alertActive"
            :text="'Такая статья уже существует!'"
        ></titlealert>

        <modal-edit-blog
            :formDialog.sync="formDialog"
            :selected.sync="selected"
            :editBlog="editor"
            :edt.sync="edt"
            :categories="categories"
            :blogs="blogs"
            :alert.sync="alertActive"
        ></modal-edit-blog>
        
        <blogs
            :blogs="blogs"
            :editBlog="editor"
            :edt.sync="edt"
            :formDialog.sync="formDialog"
            :selected.sync="selected"
            v-on:confirm="$root.confirmAction"
            :categories="categories"
        ></blogs>
    </v-container>
</template>

<script>
    import TitleAlert from '../UserProfile/PasswordAlert.vue'
    import ModalEditBlog from './ModalEditBlog.vue';
    import Blogs from './Blogs.vue';
    export default {
        components:{
            'modal-edit-blog': ModalEditBlog,
            blogs: Blogs,
            titlealert: TitleAlert,
        },
        name: 'rubric',
        data: function() {
            return {
                location: window.location.origin,
                categories: this.$store.state.data.categories,
                blogs: this.$store.state.data.blogs,
                selected: null,
                formDialog: false,
                editor: {},
                edt: false,
                alertActive: false
            }
        },
        watch: {
            selected: function(a){
                if(a){
                    for( let i = 0; i < this.blogs.length; i++){
                        let item = this.blogs[i];
                        if(item.id === a){
                            this.editor = JSON.parse(JSON.stringify(item));
                            this.editor.small_cover = this.location + '/upload/blog/' + item.small_cover;
                            this.editor.big_cover = this.location + '/upload/blog/' + item.big_cover;
                            break;
                        } 
                    }
                    setTimeout(()=>{
                        this.edt = false
                    },100)
                }else{
                    this.editor = {
                        rubric: [],
                        small_cover: '',
                        big_cover: ''
                    };
                    setTimeout(()=>{
                        this.edt = false
                    },100) 
                }
            }
        }
    }
</script>
