<template>
    <v-card>
        <v-card-title class="py-0 table-header__btn">
            <v-sheet style="position: relative; top: -24px; transition: .3s ease; z-index: 1" class="pa-7 text-center green rounded b-user-info__square"
                elevation="5"
            >
                <v-icon class="theme--dark" style="font-size: 32px;">
                    mdi-format-list-bulleted
                </v-icon>

                <v-tooltip 
                    top
                >
                    <template v-slot:activator="{ on }">
                        <v-icon
                            :disabled="Boolean(select)"
                            v-on="on"
                            v-on:click="$emit('update:formState', true);"
                        >
                            mdi-plus
                        </v-icon>
                    </template>
                    <span>Cоздать категорию</span>
                </v-tooltip>
    
            </v-sheet>
            <span class="mb-6 font-weight-light user-info__title">Управление категориями</span>
            <v-spacer></v-spacer>
            <transition name="fade" mode="out-in">
                <div class="d-flex" transition="fab-transition" v-if="select">
                    <div class="mx-2"></div>
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <v-icon
                                v-bind="attrs"
                                v-on="on"
                                v-on:click="$emit('update:formState', true);"
                            >
                                mdi-pencil
                            </v-icon>
                        </template>
                        <span>Редактирвать категорию</span>
                    </v-tooltip>
                    <div class="mx-2"></div>
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <v-icon
                                v-bind="attrs"
                                v-on="on"
                                v-on:click="$emit('confirm', $event, {type:'deleteCategory',action: deleteCategory})"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                        <span>Удалить категорию</span>
                    </v-tooltip>
                    <div class="mx-2"></div>
                </div>
            </transition>

        </v-card-title>
        <div
            style="width:100%;
                   height:400px;
                   display: flex;
                   justify-content: center;
                   align-items: center;"
            v-if="!categoriesListSlice.length"
        >
            Нет не одной категории
        </div>
        <v-simple-table
            v-else
            class="b-table b-table-categories"
            :fixed-header="true"
            style='overflow-x: hidden;padding: 0 16px 16px 16px;'
        >

            <thead>
                <tr class="b-tr">
                    <th class="b-td b-td--1 green--text">
                        ID
                    </th>
                    <th class="b-td b-td--2 text-center green--text">
                        Url
                    </th>
                    <th class="b-td b-td--3 green--text">
                        Название
                    </th>
                    <th class="b-td b-td--4 green--text">
                        Заголовок
                    </th>
                    <th class="b-td b-td--5 green--text">
                        Описание
                    </th>
                    <th class="b-td b-td--6 green--text">
                        Дата
                    </th>
                    <th class="b-td b-td--7 text-center green--text">
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr class="b-tr"
                    :class="{'green lighten-3': select === item.id}" 
                    v-for="(item, index) in categoriesListSlice"
                    :key="item.id"
                >
                    <td class="b-td b-td--1 text-left">{{ item.id }}</td>
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
                                        <a :href="location + '/rubric/' + item.slug" target="blank">{{item.slug}}</a>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </td>
                    <td class="b-td b-td--3 text-left"><span class="b-ellipsis">{{ item.title }}</span></td>
                    <td class="b-td b-td--4 text-left"><span class="b-ellipsis">{{ item.name_zu }}</span></td>
                    <td class="b-td b-td--5 text-left"><span class="b-ellipsis">{{ item.small_desc }}</span></td>
                    <td class="b-td b-td--6">{{item.created_at}}</td>
                    <td class="b-td b-td--7" style="padding-top: 0!important;padding-bottom: 0!important;">
                        <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn icon
                                    v-bind="attrs"
                                    v-on="on"
                                    v-on:click="selectedId($event, null)"
                                    v-if="select === item.id"
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
                            <span>{{select === item.id ? 'Отменить':'Выделить'}}</span>
                        </v-tooltip>
                    </td>
                </tr>
            </tbody>
        </v-simple-table>
    </v-card>
</template>

<script>
    export default {
        name: 'categorie',
        props: ['select','formState','categoriesList','edit', 'edt'],
        data: function() {
            return {
                location: window.location.origin,
            }
        },
        computed:{
            categoriesListSlice: function(){
                return this.categoriesList;
            },
        },
        methods: {
            scroll:function(e){
                //console.log(e);
            },
            getString:function(str){
                let stringArr = str.split(" ", 4);
                console.log(stringArr);
                return stringArr.join(' ')+' ...';
            },
            selectedId: function(e, item){
                if ( this.edt ) {
                    this.$emit('confirm', e, {
                        type: 'set_editor',
                        input: item,
                        action: this.emitId
                    });                    
                }else{
                    this.$emit('update:select',item)
                }
            },
            emitId:function(item){
                this.$emit('update:select', item)
            },
            deleteCategory: function(){
                let data = new FormData();

                data.append('_token', window._token);
                data.append('id', this.select);
                
                axios.post('/editor/category/delete', data)
                .then((response) => {
                   for(let i = 0; i < this.categoriesList.length; i++){
                        let item = this.categoriesList[i];
                        if(this.select === item.id){
                            this.$parent.categories.splice(i,1);
                            this.$emit('update:select', null);
                            break;
                        }
                    }
                })
                .catch((error)=> {
                    console.log(error);
                })
                .finally(()=>{
                })
            },
        },
    }
</script>