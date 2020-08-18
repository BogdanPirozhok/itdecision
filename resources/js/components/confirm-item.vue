<template>
    <transition name="fade">
        <div class="overlay_af" v-show="open" style="display: none">
            <div class="action-confirm" id="confirm-item" 
                :class="[
                    {active: activeClass}, 
                    classData,
                    {
                        'confirm-exit--top': dopClass && data_action.type === 'logout', 
                        'confirm-notif--top': dopClass && data_action.type === 'BVersion'
                    }
                ]" 
                :style="styleList"
            >
                <a href="#0" class="close" v-on:click.prevent="open = false">
                    <svg width="26" height="26" fill="#000" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.6451 12.8807L0.245573 24.3599C-0.0711265 24.6788 -0.0711265 25.1954 0.245573 25.5143C0.403721 25.674 0.611366 25.7534 0.818609 25.7534C1.02625 25.7534 1.2335 25.674 1.39164 25.5143L12.8769 13.9488L24.3622 25.5143C24.5207 25.674 24.728 25.7534 24.9352 25.7534C25.1425 25.7534 25.3501 25.674 25.5083 25.5143C25.825 25.1954 25.825 24.6788 25.5083 24.3599L14.1091 12.8807L25.5159 1.39336C25.8326 1.07445 25.8326 0.557791 25.5159 0.23888C25.1992 -0.0796266 24.6861 -0.0796266 24.3698 0.23888L12.8773 11.8125L1.3836 0.239285C1.0669 -0.0792214 0.554223 -0.0792214 0.237524 0.239285C-0.0791747 0.558197 -0.0791747 1.07486 0.237524 1.39377L11.6451 12.8807Z"></path>
                    </svg>
                </a>
                <p v-html="getData.title"></p>
                <a id="first_btn" v-show="getData.btn.first" class="action-btn" href="#" v-on:click.prevent>{{ getData.btn.first }}</a>
                <a id="last_btn" class="action-btn" href="#" v-on:click.prevent>{{ getData.btn.last }}</a>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['lang'],
        data: function() {
            return {
                key: 0,
                open: false,
                type: false,
                dopClass: false,
                classData: false,
                styleList: false,
                activeClass: false,
                data_action: false
            }
        },
        watch: {
            open: function() {
                var that = this;

                if ( this.open ) {
                    setTimeout(function(){
                        that.activeClass = true;
                    }, 200)
                }else{
                    this.activeClass = false;

                    setTimeout(() => {
                        this.classData = 'hide';
                        this.styleList = false;

                    }, 100)

                    first_btn.removeEventListener('click', this.data_action.confirm);
                    last_btn.removeEventListener('click', this.data_action.revoke);
                }
                scroll_hidden('confirm');
            }
        },
        computed: {
            getData: function(){
                switch (this.type) {
                    case 'logout': 
                        return {
                            title: this.__('Вы действительно хотите выйти из аккаунта?'),
                            btn: {
                                first: this.__('выйти'),
                                last: this.__('остаться')
                            }
                        }
                    case 'rm_user': 
                        return {
                            title: 'Вы действительно хотите удалить данного пользователя?',
                            btn: {
                                first: 'подтвердить',
                                last: 'отменить'
                            }
                        }
                    case 'rm_order': 
                        return {
                            title: 'Вы действительно хотите удалить данную заявку?',
                            btn: {
                                first: 'подтвердить',
                                last: 'отменить'
                            }
                        }
                    case 'set_editor': 
                        return {
                            title: 'Несохраненные изменения текущей редакции будут потеряны',
                            btn: {
                                first: 'продолжить',
                                last: 'назад'
                            }
                        }
                    case 'rm_singel': 
                        return {
                            title: 'Вы действительно хотите удалить данную запись?',
                            btn: {
                                first: 'подтвердить',
                                last: 'отменить'
                            }
                        }
                    case 'cancelReq':
                        return {
                            title: 'Вы действительно хотите отменить заявку?',
                            btn: {
                                first: 'подтвердить',
                                last: 'отменить'
                            }
                        }
                    case 'back_to_edit': 
                        return {
                            title: 'Имеются незаполненные данные, если вернуться в редактор, записи с пустыми значениями будут удалены',
                            btn: {
                                first: 'вернуться',
                                last: 'остаться'
                            }
                        }
                    case 'period_analytics': 
                        return {
                            title: this.__('Период который Вы выбрали, содержит <b>недостаточно данных</b>.<br><br>Система <b>автоматически расширила</b> его до приемлемых значений'),
                            btn: {
                                last: this.__('понятно, продолжаем')
                            }
                        }
                    case 'save_control_client': 
                        return {
                            title: 'Имеются незаполненные данные, записи с пустыми значениями будут удалены',
                            btn: {
                                first: 'продолжить',
                                last: 'отменить'
                            }
                        }
                    case 'close_control_client': 
                        return {
                            title: 'Несохранённые данные будут утеряны',
                            btn: {
                                first: 'продолжить',
                                last: 'отменить'
                            }
                        }
                    case 'resetToZero': 
                        return {
                            title: this.__('Вы действительно хотите сбросить все транзакции?'),
                            btn: {
                                first: this.__('Да'),
                                last: this.__('Нет')
                            }
                        }
                    case 'zeroTrans': 
                        return {
                            title: this.__('Вы еще не совершили ни одной транзакции'),
                            btn: {
                               	last: this.__('понятно')
                            }
                        }
                    case 'deletTrans': 
                        return {
                            title: this.__('Вы действительно хотите удалить транзакцию?'),
                            btn: {
                                first: this.__('Да'),
                                last: this.__('Нет')
                            }
                        }
                    case 'deleteBlog': 
                        return {
                            title: this.__('Вы действительно хотите удалить статью?'),
                            btn: {
                                first: this.__('Да'),
                                last: this.__('Нет')
                            }
                        }
                    case 'deletOrder': 
                        return {
                            title: this.__('Вы действительно хотите удалить заявку?'),
                            btn: {
                                first: this.__('Да'),
                                last: this.__('Нет')
                            }
                        }
                    case 'BVersion': 
                        return {
                            title: this.__('Бета-версия! В данный момент эта функция недоступна, в скором времени мы закончим работу и все функции будут доступны'),
                            btn: {
                                last: this.__('понятно')
                            }
                        }
                    case 'deleteCategory': 
                        return {
                            title: this.__('Вы действительно хотите удалить категорию?'),
                            btn: {
                                first: this.__('Да'),
                                last: this.__('Нет')
                            }
                        }
                        
                    default:
                        return {
                            title: this.__('Подтвердить действие?'),
                            btn: {
                                first: this.__('подтвердить'),
                                last: this.__('отменить')
                            }
                        }
                }
            } 
        },
        methods: {
            __: function(str) {
                // var data = window.glossary.user;

                // if ( this.lang && this.lang.selected != 'ru' ) {
                //     for (var i = 0; i < data.length; i++) {
                //         if ( data[i].toLowerCase().indexOf(str.toLowerCase()) != -1 ) {
                //             return data[i].split(' | ')[this.lang.items.indexOf( this.lang.selected )];
                //         }
                //     }
                //     return str +' (no translation)'
                // }else{
                    return str;
                // }
            },
            action: function(data) {
                var that = this;
                this.type = data.type;
                this.open = true;
                this.data_action = data;

                setTimeout(function(){
                    var obj = document.getElementById('confirm-item').getBoundingClientRect(),
                        target = !data.target.length ? (data.target.target ? data.target.target.getBoundingClientRect() : data.target.getBoundingClientRect()) : {
                            right: data.target[0].pageX,
                            left: data.target[0].pageX,
                            top: data.target[0].pageY
                        };

                    if(target.top <= 70){
                        that.dopClass = true;
                    }else{
                        that.dopClass = false;
                    }

                    if ( window.innerWidth - target.right > obj.width + 50 ) {
                        that.classData = 'right';
                        that.styleList = {
                            left: Math.round(target.right) + 'px',
                            top: target.height ? Math.round(target.top) + Math.round(target.height / 2) + 'px' : Math.round(target.top) + 'px'
                        }
                    }else{
                        that.classData = 'left';
                        that.styleList = {
                            left: Math.round(target.left) + 'px',
                            top: target.height ? Math.round(target.top) + Math.round(target.height / 2) + 'px' : Math.round(target.top) + 'px'
                        }
                    }
                }, 50)

                first_btn.addEventListener('click', this.data_action.confirm, {once: true});
                last_btn.addEventListener('click', this.data_action.revoke, {once: true});
            }
        }
    }
</script>