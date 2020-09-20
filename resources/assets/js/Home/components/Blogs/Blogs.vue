<template>
	<v-card>
        <v-card-title class="py-0 table-header__btn">
            <v-sheet style="position: relative; top: -24px; transition: .3s ease; z-index: 1" class="pa-7 text-center green rounded b-user-info__square"
                elevation="5"
            >
                <v-icon class="theme--dark" style="font-size: 32px;">
                    mdi-clipboard-text
                </v-icon>

                <v-tooltip 
                    top
                >
                    <template v-slot:activator="{ on }">
                        <v-icon
                            :disabled="Boolean(selected)"
                            v-on="on"
                            v-on:click="$emit('update:formDialog', true)"
                        >
                            mdi-plus
                        </v-icon>
                    </template>
                    <span>Cоздать статью</span>
                </v-tooltip> 

            </v-sheet>
            <span class="mb-6 font-weight-light user-info__title">Управление статьями</span>
            <v-spacer></v-spacer>
            <transition name="fade" mode="out-in">
                <div class="d-flex" transition="fab-transition" v-if="selected">
                    <div class="mx-2"></div>
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <v-icon
                                v-bind="attrs"
                                v-on="on"
                                v-on:click="$emit('update:formDialog', true)"
                            >
                                mdi-pencil
                            </v-icon>
                        </template>
                        <span>Редактирвать статью</span>
                    </v-tooltip>
                    <div class="mx-2"></div>
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <v-icon
                                v-bind="attrs"
                                v-on="on"
                                v-on:click="$emit('confirm', $event, {type:'deleteBlog',action: deleteBlog})"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                        <span>Удалить статью</span>
                    </v-tooltip>
                    <div class="mx-2"></div>
                </div>
            </transition>
        </v-card-title>
        <v-simple-table
            class="b-table b-table-articles"
            :fixed-header="true"
            style='overflow-x: hidden;padding: 0 16px 16px 16px;'
        >
            <thead>
                <tr class="b-tr">
                    <th class="b-td b-td--1 green--text">
                        ID
                    </th>
                    <th class="b-td b-td--2 green--text text-center">
                        Url
                    </th>
                    <th class="b-td b-td--3 green--text">
                        Заголовок
                    </th>
                    <th class="b-td b-td--4 green--text">
                        Рубрики
                    </th>
                    <th class="b-td b-td--5 green--text">
                        Автор
                    </th>
                    <th class="b-td b-td--6 green--text text-center">
                        Дата
                    </th>
                    <th class="b-td b-td--7 green--text text-center">
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr
                    class="b-tr"
                    :class="{'green lighten-3': selected === item.id}" 
                    v-for="(item, index) in blogsSlice"
                    :key="item.id"
                >
                    <td class="b-td b-td--1 ">{{item.id}}</td>
                    <td class="b-td b-td--2" style="padding-top: 0!important;padding-bottom: 0!important;">
                        <v-menu
                            bottom
                            right
                            offset-y
                            transition="scale-transition"
                        >
                            <template v-slot:activator="{ attrs, on }">
                                <v-btn
                                    min-width="0"
                                    text
                                    icon
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    <v-icon>mdi-share</v-icon>
                                </v-btn> 
                            </template>
                            <v-list>
                                <v-list-item>
                                    <v-list-item-title>
                                        <a :href="location + '/singel/' + item.slug" target="blank">{{item.slug}}</a>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </td>
                    <td class="b-td b-td--3 text-left"><span class="b-ellipsis">{{ item.title }}</span></td>
                    <td class="b-td b-td--4 text-left">
                        <template 
                            v-for="(i, index) in item.rubric"
                        >
                            {{catList[i]}}<template v-if="item.rubric.length !== 1 && index !== item.rubric.length - 1">, </template>
                        </template>
                    </td>
                    <td class="b-td b-td--5 text-left"><span class="b-ellipsis">{{ item.fullname }}</span></td>
                    <td class="b-td b-td--6">{{ item.created_at }}</td>
                    <td class="b-td b-td--7" style="padding-top: 0!important;padding-bottom: 0!important;">
                        <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn icon
                                    v-bind="attrs"
                                    v-on="on"
                                    v-on:click="selectedId($event, null)"
                                    v-if="selected === item.id"
                                >
                                    <v-icon color="green">mdi-dots-vertical</v-icon>
                                </v-btn>
                                <v-btn icon
                                    v-bind="attrs"
                                    v-on="on"
                                    v-on:click="selectedId($event, item.id)"
                                    v-else
                                >
                                    <v-icon color="grey lighten-1">mdi-dots-vertical</v-icon>
                                </v-btn>
                            </template>
                            <span>{{selected === item.id ? 'Отменить':'Дополнительно'}}</span>
                        </v-tooltip>
                    </td>
                </tr>
            </tbody>
        </v-simple-table>
        <v-col cols="11" class="pb-4 px-0 pt-0" style="margin: 0 auto;">
            <v-pagination
                v-model="selectPag"
                color="green"
                :length="Math.ceil(this.blogs.length / 10)"
                :total-visible="7"
            ></v-pagination>
        </v-col>
    </v-card>
</template>

<script>
	export default{
		props:['blogs', 'selected','formDialog', 'editBlog', 'edt', 'categories'],
		data: function(){
			return{
                selectPag: 1,
				location: window.location.origin,
			}
		},
		computed:{
			blogsSlice: function(){
                let start = (this.selectPag-1) * 10,
                    end = start + 10
                return this.blogs.slice(start,end);
            },
            catList: function() {
                var categoriesList = {};
                for(var i = 0; i < this.categories.length; i++){
                    var item = this.categories[i];
                    categoriesList[item.id] = item.small_title;
                }
                return categoriesList;
            },
		},
		methods:{
			scroll:function(e){
                //console.log(e);
            },
            selectedId: function(e, item){
                if ( this.edt ) {
                    this.$emit('confirm', e, {
                        type: 'set_editor',
                        input: item,
                        action: this.emitId
                    });                    
                }else{
                    this.$emit('update:selected',item)
                }
            },
            emitId:function(item){
                this.$emit('update:selected', item)
            },
			deleteBlog: function(){
                axios.post('/editor/delete/blog', {
                    _token:  window._token,
                    id: this.selected
                })
                .then((response) => {
                    for(let i = 0; this.blogs.length; i++){
                        let item = this.blogs[i];
                        if(this.selected === item.id){
                            this.blogs.splice(i,1);
                            this.$emit('update:selected', null);
                            break;
                        }
                    }
                    
                })
                .catch((error)=> {
                    console.log(error);
                })
                .finally(()=>{
                    this.dialog = false;
                })
            },
		}
	}
</script>
