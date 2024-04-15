
var tdPanelVueComponents = {};


//TD PANEL AUTHOR SELECTOR
tdPanelVueComponents['td-panel-author-selector'] = new Vue({
    el: '#td-panel-author-selector',
    template: `<div>
                <!-- TDB users templates -->
                <div class="td-box-description">
                    <span class="td-box-title">TDB author templates</span>
                    <p>Set a <a :href="getAdminUrl() + 'edit.php?post_type=tdb_templates#/load'">WP Templates</a> builder category template for this category.</p>
                </div>                             
                
                <div class="td-box-control-full">
                    
                    <!-- Error -->
                    <div v-if="error">
                        {{error}}                    
                    </div>
                    
                    <!-- User list -->                                                                                                   
                    <div v-for="user in userList">
                        <span>{{user.ID}}</span>
                        <span>{{user.user_login}}</span>
                        
                        <select v-model="user.tdb_template_id">
                            <option value="">- Default template -</option>
                            <option v-for="(template, index) in templates" :value="index" :key="index">{{template}}</option>
                        </select>
                        
                    </div>                                             
                </div>

            </div>`,
    data() {
        return {
            userList: null,
            templates: null,
            error: null
        }
    },
    created() {
        //load ajax data only when template settings panel is opened
        tdPanelEventBus.on('td-panel-template-settings', this.getAjaxData, this, true);
    },
    methods: {
        getAdminUrl() {
            return window.td_admin_url;
        },
        getAjaxData(data) {
            let vm = this;

            tdPanelVueAjax({
                post: {
                    td_data_type: 'author-templates'
                },
                success(apiReply) {
                    vm.userList = apiReply['td_users_list'];
                    vm.templates = apiReply['td_author_templates'];
                },
                error(errorMsg) {
                    vm.error = errorMsg;
                }

            });
        },
        getData() {
            // return string in POST format (string of properties separated by &)
            // called in td_ajax_form_submit
            if (!this.userList) {
                return '';
            }

            let buffy = '';

            for (let userId in this.userList) {
                if (Object.hasOwnProperty.call(this.userList, userId)) {
                    let userData = this.userList[userId];

                    if (buffy !== '') {
                        buffy += '&';
                    }

                    buffy += 'td_author_template[' + userId + ']=' + userData['tdb_template_id'];
                }
            }

            return buffy;
        }
    }
});

