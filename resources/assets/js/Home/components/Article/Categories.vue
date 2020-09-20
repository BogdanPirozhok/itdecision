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
            <span class="mb-6 font-weight-regular user-info__title">Управление категориями</span>
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
            v-if="!tasksListListSlice.length"
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
                    <th class="b-td green--text">
                        ID
                    </th>
                    <th class="b-td green--text">
                        Название
                    </th>
                    <th class="b-td green--text">
                        Front-end
                    </th>
                    <th class="b-td green--text">
                        Back-end
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr class="b-tr"
                    :class="{'green lighten-3': select === item.id}"
                    v-for="(item, index) in tasksListListSlice"
                    :key="item.id"
                >
                    <td class="b-td text-left">{{ index + 1 }}</td>
                    <td class="b-td text-left"><span class="b-ellipsis">{{ item.name }}</span></td>
                    <td class="b-td text-left">
                        <v-col class="pl-0 pb-1 pt-5" cols="12">
                            <v-text-field label="кол-во часов" type="number" solo
                                :error-messages="[]"
                                :loading="false"
                                v-model.number="input[0][item.id]"
                                v-on:input="change = {
                                    stack: 0,
                                    id: item.id
                                }"
                            ></v-text-field>
                        </v-col>
                    </td>
                    <td class="b-td text-left">
                        <v-col class="pl-0 pb-0 pt-5" cols="12">
                            <v-text-field label="кол-во часов" type="number" solo
                                  :loading="false"
                                  v-model.number="input[1][item.id]"
                            ></v-text-field>
                        </v-col>
                    </td>
                </tr>
            </tbody>
        </v-simple-table>
    </v-card>
</template>

<script>
    export default {
        props: ['select', 'formState', 'tasksList', 'edit', 'edt'],
        data: function() {
            return {
                location: window.location.origin,
                input: [{}, {}],
                change: {}
            }
        },
        computed:{
            tasksListListSlice: function(){
                return this.tasksList;
            },
        },
        watch: {
            change: function () {
                console.log( this.input[this.change.stack][this.change.id] )
            }
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
                   for(let i = 0; i < this.tasksList.length; i++){
                        let item = this.tasksList[i];
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
