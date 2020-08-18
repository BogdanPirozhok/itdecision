<template>
    <v-container
        fluid
        tag="section"
    >
        <titlealert
            :active="alertActive"
            :text="'Такая категория уже существует!'"
        ></titlealert>

        <categorie
            :categoriesList="categories"
            :select.sync="selected"
            :formState.sync="formDialog"
            :edit="edit"
            :edt.sync="edt"
            v-on:confirm="$root.confirmAction"
        >
        </categorie>

        <editform
            :formDialog.sync="formDialog"
            :edit.sync="edit"
            :selected.sync="selected"
            :categoriesList="categories"
            :edt.sync="edt"
            :alert.sync="alertActive"
        >
        </editform>
    </v-container>
</template>

<script>
    import TitleAlert from '../UserProfile/PasswordAlert.vue'
    import Categories from './Categories.vue'
    import editForm from './EditForm.vue'
    export default {
        name: 'articles',
        components: {
            categorie: Categories,
            editform: editForm,
            titlealert: TitleAlert,
        },
        data: function() {
            return {
                categories: this.$store.state.data.categories,
                selected: null,
                formDialog: false,
                edit: {},
                edt: false,
                alertActive: false
            }
        },
        watch: {
            selected: function(a){
                if(a){
                    for( let i = 0; i < this.categories.length; i++){
                        let item = this.categories[i];
                        if(item.id === a){
                            this.edit = JSON.parse(JSON.stringify(item));
                            break;
                        } 
                    }
                    setTimeout(()=>{
                        this.edt = false
                    },100)
                }else{
                    this.edit = {};
                    setTimeout(()=>{
                        this.edt = false
                    },100) 
                }
            },
        },
    }
</script>