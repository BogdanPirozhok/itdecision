<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            :dark="true"
            app
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url(/img/sidebar-1.jpg);background-position: center;background-size: cover;"
        >
            <v-divider style="width:calc(100% - 32px)!important;" class="ml-4"></v-divider>
            <v-list-item class="px-3 py-3">
                <v-list-item-avatar class="mr-3 ml-2">
                    <v-img 
                        :src="location + '/upload/blog/' + userInfo.avatar"
                    ></v-img>
                </v-list-item-avatar>
                <v-list-item-title class="mr-2">{{userInfo.fullname}}</v-list-item-title>
            </v-list-item>
            <v-divider style="width:calc(100% - 32px)!important;" class="ml-4"></v-divider>
            <v-list-item-group
                :mandatory="true"
                style="padding:8px 16px;"
                v-model="selectItem"
                active-class="deep-white--text text--accent-4"
            >
                <v-list v-for="(item, index) in items" :key="item.component" dense class="py-1">
                    <v-list-item
                        active-class="deep-white--text text--accent-4"
                        class="px-2"
                        :value="item.component"
                    >
                        <v-list-item-icon class="my-3 mr-4 ml-1">
                            <v-icon>{{item.icon}}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title class="font-weight-light text-body-2">{{item.title}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-list-item-group>
        </v-navigation-drawer>

        <v-app-bar
            absolute
            app
            color="transparent"
            flat
            fixed
            height="75"
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>{{selecteditem.title}}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn
                class="ml-2"
                min-width="0"
                text
                @click="selectItem = 'articles'"
            >
                <v-icon>mdi-view-dashboard</v-icon>
            </v-btn>
            <v-menu
                bottom
                left
                offset-y
                origin="top right"
                transition="scale-transition"
            >
                <template v-slot:activator="{ attrs, on }">
                    <v-btn
                        class="ml-2"
                        min-width="0"
                        text
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-badge
                            color="red"
                            overlap
                            bordered
                        >
                            <template v-slot:badge>
                                <span>5</span>
                            </template>
                            <v-icon>mdi-bell</v-icon>
                        </v-badge>
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item>
                        <v-list-item-title>Option 1</v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Option 2</v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Option 3</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-menu
                bottom
                left
                offset-y
                origin="top right"
                transition="scale-transition"
            >
                <template v-slot:activator="{ attrs, on }">
                    <v-btn
                        class="ml-2"
                        min-width="0"
                        text
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-icon>mdi-account</v-icon>
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item>
                        <v-list-item-title>Выйти</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-main>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col class="text-center">
                        <v-tooltip left>
                            <template v-slot:activator="{ on }">
                                <div>
                                    <keep-alive>
                                        <component :is="selecteditem.component"></component>
                                    </keep-alive>
                                </div>
                            </template>
                        </v-tooltip>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    import Rubric from './Blogs/Rubric.vue'
    import UserProfile from './UserProfile/UserProfile.vue'
    import Summary from './Summary/Summary.vue'
    import Articles from './Article/Articles.vue'
    import Subscribers from './Subscribers/Subscribers.vue'
    export default {
        name: 'index',
        props: {
            source: String,
        },
        components: {
            rubric: Rubric,
            articles: Articles,
            summaring: Summary,
            userprofile: UserProfile, 
            subscribers: Subscribers
        },
        data: function() {
            return {
                location: window.location.origin,
                group: null,
                selectItem: this.$store.state.data.divide ? this.$store.state.data.divide : 'subscribers',
                expandOnHover: false,
                drawer: null,
                items: [
                    // {
                    //     title: 'Сводка',
                    //     icon: 'mdi-view-dashboard',
                    //     component: 'summaring'
                    // },
                    {
                        title: 'Комьюнити',
                        icon: 'mdi-account-multiple',
                        component: 'subscribers'
                    },
                    {
                        icon: 'mdi-account',
                        title: 'Профиль',
                        component: 'userprofile'
                    },
                    {
                        title: 'Категории',
                        icon: 'mdi-format-list-bulleted',
                        component: 'articles',
                      
                    },
                    {
                        title: 'Статьи',
                        icon: 'mdi-clipboard-text',
                        component: 'rubric'
                    },
                ],
            }
        },
        watch:{
            selectItem: function(){
                window.history.replaceState(null, null, window.location.origin +'/editor?divide='+ this.selecteditem.component);
            }
        },
        computed: {
            selecteditem: function() {
                for(let i = 0; this.items.length; i++){
                    let item = this.items[i];
                    if(item.component === this.selectItem){
                        return item;
                        break;
                    }
                } 
            },
            userInfo: function() {
                return this.$store.getters.userData;
            }
        }
    }
</script>


