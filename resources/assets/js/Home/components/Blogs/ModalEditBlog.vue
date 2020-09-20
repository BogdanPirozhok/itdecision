<template>
    <v-overlay
        :value="formDialog"
        class="b-overlay"
        z-index="7"
    >
        <div class="b-drawer b-drawer--left"
            :class="{active: e}"
        >
            <ckeditor  v-model="edit.text" :config="editorConfig"></ckeditor>

            <v-btn
                icon
                v-on:click="e = !e"
            >
                <v-icon>mdi-close</v-icon>
            </v-btn> 
        </div>
        
        <div class="b-drawer b-drawer--right"
            :class="{active: drawer}"
        >
            <v-card 
                light
                class="rounded-0 mt-0 mb-0 b-new-article"
                >
                <v-card-title class="px-0 pt-0">
                    <span class="headline">
                        {{ !selected ? 'Новая статья' : 'Редактирование' }}
                    </span>
                </v-card-title>
                <v-card-text class="pb-0 px-0">
                    <v-form
                        ref="form"
                        v-model="valid"
                    >
                        <div class="b-add-img__box">
                            <label class="b-add-img mt-8"
                                :class="{active: edit.small_cover}"
                                v-on:click="fileManager('small_cover')"
                            >
                                <span>Маленькая обложка</span>
                                <img v-bind:src="edit.small_cover" v-if="edit.small_cover"/>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#949494" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M492,236H276V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v216H20c-11.046,0-20,8.954-20,20s8.954,20,20,20h216v216c0,11.046,8.954,20,20,20s20-8.954,20-20V276h216c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z"></path></svg>
                            </label>

                            <label class="b-add-img mt-8"
                                 :class="{active: edit.big_cover}"
                                 v-on:click="fileManager('big_cover')"
                            >
                                <span>Большая обложка</span>
                                <img v-bind:src="edit.big_cover" v-if="edit.big_cover"/>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#949494" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M492,236H276V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v216H20c-11.046,0-20,8.954-20,20s8.954,20,20,20h216v216c0,11.046,8.954,20,20,20s20-8.954,20-20V276h216c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z"></path></svg>
                            </label>
                        </div>

                        <v-select
                            height="40"
                            color="green"
                            class="pb-3 select"
                            v-model="edit.rubric"
                            :items="category"
                            item-value="id"
                            item-text="title"
                            :rules="rubricRules"
                            :counter="category.length"
                            label="Рубрика /и"
                            multiple
                        >
                            <template v-slot:selection="{ item, index }">
                                <v-chip v-if="index === 0">
                                    <span>{{ item.id }}</span>
                                </v-chip>
                                <span
                                    v-if="index === 1"
                                    class="grey--text caption"
                                >(+{{ edit.rubric.length - 1 }} категории)</span>
                            </template>
                        </v-select>

                        <v-textarea
                            class="b-textarea pb-5 mb-5"
                            style="height: 100px;"
                            v-model="edit.title"
                            :rules="getRulers(15)"
                            :counter="15"
                            name="input-7-1"
                            color="green"
                            no-resize
                            label="Название"
                        ></v-textarea>

                        <v-textarea
                            class="b-textarea pb-5 mb-5"
                            style="height: 160px;"
                            name="input-7-1"
                            v-model="edit.small_desc"
                            :rules="getRulers(30)"
                            :counter="30"
                            color="green"
                            no-resize
                            label="Краткое описание"
                        ></v-textarea>
                        <v-btn
                            color="green"
                            class="pb-3"
                            dark
                            v-on:click="e = !e" 
                        >
                           Контент
                        </v-btn>
                    </v-form>
                </v-card-text>
                <v-card-actions class="px-0 pt-6 pb-0">
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
                        v-on:click="editorBlog" 
                    >
                        Сохранить
                    </v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </v-overlay>
</template>

<script>
	export default{
		props: ['categories', 'editBlog', 'formDialog', 'selected', 'edt', 'blogs', 'alert'],
		data: function(){
			return{
                editorData: '<p>Текст...</p>',
                editorConfig: {
                    // contentsCss : 'http://laravel.in/public/css/content.css',
                    // allowedContent: true,
                    resize_enabled: false,
                    width: '100%',
                    filebrowserImageBrowseUrl: '/editor/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/editor/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/editor/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/editor/laravel-filemanager/upload?type=Files&_token='
                },
                e: false,
                drawer: false,
                form: true,
                location: window.location.origin,
				edit: {
                    rubric: [],
                    small_cover: '',
                    big_cover: ''
				},
				valid: true,
      			rubricRules: [
        			v => !!v.length || 'Это поле обязательное',
        			v => (v && v.length >= 1) || 'Должно быть 1 или больше категорий',
      			],
			}
		},
		watch: {
			editBlog: function(){
				this.edit = this.editBlog;
			},
            edit: {
                deep: true,
                handler: function(){
                    this.$emit('update:edt', true);
                }
            },
            formDialog: function(a){
                if(!a){
                    this.e = false

                    document.getElementsByTagName('html')[0].style.overflowY = 'auto';
                }else{
                    document.getElementsByTagName('html')[0].style.overflowY = 'hidden';
                }
                setTimeout(()=>{
                    this.drawer = a;
                },30)
                
                
            },
        },
		computed:{
			category: function(){
                let data = [];
                this.categories.forEach(item=>{
                    data.push({id: item.id, title: item.small_title});
                })
                return data;
            }
		},
		methods:{
            closeModal: function() {
                this.$emit('update:formDialog', false);
                this.$emit('update:alert', false);
            },
            fileManager: function(key, type){
                let that = this;
                window.open('/editor/laravel-filemanager' + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
    
                window.SetUrl = function (items) {
                    var file_path = items.map(function (item) {
                        return item.url;
                    }).join(',');
                    that.edit[key] = file_path;
                };
            },
            getRulers: function(count){
                return [
                    v => !!v || 'Это поле обязательное',
                    v => (v && v.length <= count) || `Должно быть больше ${count} символов`,
                ]
            },
			editorBlog: function(){
				if(!this.$refs.form.validate()){
					return;
				}

                var input = this.edit,
                    s = this.selected,
                    blogsList=this.blogs,
                    url = s ? '/editor/edit/blog' : '/editor/create/blog';

                for(var i = 0; i < blogsList.length; i++) {
                    if(input.title.toLowerCase() === blogsList[i].title.toLowerCase()) {
                        this.$emit('update:alert', true);
                        return;
                    }
                } 

                axios.post(url, {
                    _token: window._token,
                    input

                })
                .then((response) => {
                    let d = response.data;
                    console.log(d);
                    if(s){
                        for(let i = 0; i < this.$parent.blogs.length; i++){
                            let item = this.$parent.blogs[i];
                            if( item.id === s ){
                                input.big_cover = d.big_cover ? d.big_cover : input.big_cover;
                                input.small_cover = d.small_cover ? d.small_cover : input.small_cover;
                                input.slug = d.slug;
                                this.$parent.blogs.splice(i,1, input);
                                this.$emit('update:selected', null);
                            }
                        }
                    }else{
                        for(let key in d){
                            input[key] = d[key]
                        }
                        this.$parent.blogs.unshift(input);
                        this.edit = {
                            rubric: [],
                            small_cover: '',
                            big_cover: ''
                        };
                        setTimeout(()=>{
                            this.$emit('update:edt', false);
                        },100)
                        
                    }
                })
                .catch((error)=> {
                    console.log(error);
                })
                .finally(()=>{
                    this.$emit('update:formDialog', false);
                    this.$emit('update:alert', false);
                })
            }
		}
	}
</script>