<template>
    <v-overlay
        :value="formDialog"
        class="b-overlay"
        z-index="7"
    >
        <div class="b-drawer b-drawer--right"
        	:class="{active: formDialogRight}"
        >
            <v-card 
                light
                class="rounded-0 mt-0 mb-0 b-new-article"
            >
                <v-card-title class="px-0 pt-0">
                    <span class="headline">
                        {{ !selected ? 'Новая категория' : 'Редактирование' }}
                    </span>
                </v-card-title>
                <v-card-text>
                    <v-form
                        ref="form"
                        v-model="valid"
                    >
                        <v-text-field
                            v-model="editor.title"
                            label="Название"
                            color="green"
                            :rules="titleRule"
                            counter="15"
                        ></v-text-field>

                       <!--  <v-textarea
                            v-model="editor.name_zu"
                            label="Подзаголовок"
                            class="mb-4"
                            style="height: 160px;"
                            no-resize
                            color="green"
                            :rules="nameRule"
                            counter="150"
                        ></v-textarea>

                        <v-textarea
                            v-model="editor.small_desc"
                            name="input-7-1"
                            style="height: 160px;"
                            color="green"
                            no-resize
                            label="Описание"
                            :rules="descRule"
                            counter="1000"
                        ></v-textarea> -->
                    </v-form>
                </v-card-text>
                <v-card>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green darken-1" 
                        text v-on:click="closeModal"
                    >
                        Закрыть
                    </v-btn>
                    <v-btn 
                        color="green darken-1"  
                        text 
                        v-on:click="editCategory"
                    >
                        Сохранить
                    </v-btn>
                </v-card>
            </v-card>
        </div>
    </v-overlay>

</template>

<script>
    export default {
        name: 'formcategires',
        props: ['formDialog','edit','selected','categoriesList', 'edt', 'alert'],
        data: function() {
            return {
                editor: {},
                valid: true,
                formDialogRight: false,
                titleRule: [
                    val => !!val || 'Это поле обязательное',
                    val => (val && val.length <= 15) || 'Должно быть меньше 15 символов',
                ],
            }
        }, 
        watch: {
            edit: function() {
                this.editor = this.edit;
            },
            editor: {
                deep: true,
                handler: function(){
                    this.$emit('update:edt', true);
                }
            },
            formDialog: function(a){
            	if(a){
            		setTimeout(()=>{
            			this.formDialogRight = a;
            		},100)
            	}else{
            		this.formDialogRight = a;
            	}
            	
            }
        },
        methods: {
            closeModal: function() {
                this.$emit('update:formDialog', false);
                this.$emit('update:alert', false);
            },
            editCategory: function(){
                if(!this.$refs.form.validate()){
                    return;
                } else {
                    var s = this.selected,
                        input = this.editor,
                        categList = this.categoriesList,
                        url = s ? '/editor/category/edit' : '/editor/category/create',
                        data = new FormData();

                    data.append('_token', window._token);

                    for(let key in input){
                        data.append(key, input[key]);
                    }

                    axios.post(url, data)
                    .then((response) => {
                        
                        var data = response.data;
                        console.log(data);
                        if(data.id){
                            for(var key in data) {
                                input[key] = data[key];
                            }
                            this.$parent.categories.unshift(input);
                        } else {
                            
                            for(var i = 0; i < this.categoriesList.length; i++){
                                var item = this.categoriesList[i];
                                if(item.id === input.id) {
                                    input.slug = data;
                                    this.$parent.categories.splice(i,1, input);
                                }
                            }
                        }
                        this.$emit('update:selected', null);
                        this.$emit('update:formDialog', false);
                    })
                    .catch((error)=> {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        setTimeout(()=>{
                            this.$emit('update:edt', false);
                        },100)
                    })
                }
            },
        }     
    };
</script>
