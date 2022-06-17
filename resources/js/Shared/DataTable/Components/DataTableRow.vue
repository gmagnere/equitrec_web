<template>


    <td v-for="(schema, index) in schemas" class="px-5 py-5 border-b border-gray-200 text-sm">
        <div :class="expandable !== '' && index === 0 ? 'text-blue-400 flex': 'text-gray-900 flex justify-center'">
            <div v-if="options && index === 0">
                <label v-if="options.withLineSelection" class="mr-3 inline-flex items-center self-center ">
                    <input @click="selected(schema)" type="checkbox" class="rounded">
                </label>
            </div>
            <button  v-if="expandable !== '' && index === 0" class="flex mr-1">
                <icon @click="expandableVisible(data)" v-if="data.expandableVisible" name="chevron-up" class="cursor-pointer"></icon>
                <icon @click="expandableVisible(data)" v-else name="chevron-down" class="cursor-pointer"></icon>
            </button>

            <button  v-if="crud.includes('r') && index === 0" class="flex mr-1 text-blue-400">
                <icon @click="openData(data.id)"  name="eye" class="cursor-pointer"></icon>
            </button>

            <!-- Relation multiple-->
            <div v-if="schema.relations">
                <div v-if="schema.settings.hasOwnProperty('display')" @click="modalPreview(schema)" class="flex justify-center cursor-pointer hover:text-blue-500">
                    <icon v-if="schema.settings.display.icon" name="people-call"></icon>
                    <p v-if="schema.settings.display.type === 'list'" v-for="data in data[schema.form]" class="border rounded shadow p-2 mr-2">{{ data.name }}</p>
                    <p v-else-if="schema.settings.display.type === 'count'" class="font-bold self-center">{{data[schema.form].length}}</p>
                </div>
                <div v-else :class="getAttrClass(schema)" class="mr-2" v-for="item in data[schema.relations.split('.')[0]]">{{ item[schema.relations.split('.')[1]] }}</div>
            </div>

            <div v-else class="whitespace-no-wrap self-center flex justify-center" :class="getAttrClass(schema)"
                 :style="getAttrStyle(schema, data)">
                <span class="mr-2" v-if="data[schema.form]">{{ schema.before }}</span>
                <!--                Relation Simple-->
                <template v-if="schema.relation && data[schema.relation.split('.')[0]]">
                    <a v-if="schema.settings.readTableRoute && can(schema.settings.can)" @click="viewRelation(schema, data[schema.relation.split('.')[0]].id)" class="text-blue-500" href="#">
                        {{ resolve(schema.relation, data) }}
                    </a>
                    <span v-else>
                        {{ resolve(schema.relation, data) }}
                    </span>
                </template>
                <template v-else-if="schema.type === 'files'">
                    <div>
                        <MediasPreview :files="data[schema.form]"></MediasPreview>
                    </div>

                </template>
                <!--                COMPONENT -->
                <template v-else-if="schema.type === 'component'">
                    <components :componentName="schema.settings.componentName" :dataForm="data" :componentRole="'reader'" ></components>
                </template>
                <!--                Valeur normal-->
                <template v-else>
                    <div v-if="data[schema.form]">
                        <a v-if="schema.type === 'email' || schema.type === 'tel' "
                           :href="hrefSchema(data, schema)"
                           target="_blank"
                           class="text-blue-500 hover:underline"
                        >{{ data[schema.form] }}</a>
                        <span v-else-if="schema.type === 'date'">{{ format_date(data[schema.form]) }}</span>
                        <span v-else-if="schema.type === 'checkbox'">
                            <input v-model="data[schema.form]" type="checkbox" disabled class="form-checkbox rounded h-5 w-5 text-blue-600">
                        </span>
                        <span v-else>
                            <display-component v-if="schema.displayComponent" :componentName="schema.displayComponent" :data="data" :options="schema.displayOptions"></display-component>
                            <span v-else>{{ data[schema.form] }}</span>
                        </span>
                    </div>
                </template>


                <span class="ml-2" v-if="data[schema.form]">{{ schema.after }}</span>
            </div>
        </div>


    </td>

</template>

<script>
import Icon from "@/Shared/Components/Icon";
import MediasPreview from "@/Shared/Components/MediasPreview";
import moment from 'moment'
import DialogModal from "@/Jetstream/DialogModal";
import Components from "@/Shared/DataTable/Components/Components"
import DisplayComponent from "@/Shared/DataTable/Components/DisplayComponent"


export default {
    name: "DataTableRow",
    props: {
        schemas: Array,
        data: Object,
        crud: {
            type: String,
            default: ""
        },
        expandable: {
            type: String,
            default: ""
        },
        options: {
            type: Object,
            default: null
        },
        routeName: {
            type: String,
            default: null
        }
    },
    components: {
        Icon,
        MediasPreview,
        DialogModal,
        Components,
        DisplayComponent
    },
    emits: ['onLineSelected', 'modalPreview'],
    methods: {
        resolve(path, obj) {
            return path.split('.').reduce(function (prev, curr) {
                return prev ? prev[curr] : null
            }, obj || self)
        },
        resolveArray(path, obj, index) {
            return path.split('.').reduce(function (prev, curr) {
                return prev ? prev[curr] : null
            }, obj || self)
        },
        getAttrClass(schema) {
            if (schema.attr) {
                return schema.attr.class ? schema.attr.class : ''
            }
        },
        getAttrStyle(schema, data) {
            if (schema.attr) {
                if (schema.attr.style) {

                    let style = ""

                    schema.attr.style.split(';').forEach(function (item) {
                        let indexOfFirst = item.indexOf(':') + 1
                        let subStyle = item.slice(0, indexOfFirst)
                        let value = item.slice(indexOfFirst)

                        if (value.indexOf('{{') > 0) {
                            value = item.slice(indexOfFirst)
                                .replace(' ', '')
                                .replace('{{', '')
                                .replace('}}', '')
                            value = value.split('.').reduce(function (prev, curr) {
                                return prev ? prev[curr] : null
                            }, data || self)
                        }
                        style += subStyle + value + ';'

                    });
                    return style
                }
            }
        },
        expandableVisible(data) {
            data.expandableVisible = !data.expandableVisible;
        },
        openData(id) {
            window.location.href = route( this.routeName + '.edit', id);
        },
        hrefSchema(data, schema) {
            switch (schema.type) {
                case 'email':
                    return "mailto:" + data[schema.form]
                case 'tel':
                    return "tel:" + this.setCharAt(data[schema.form],0,'+33')
            }
        },
        setCharAt(str,index,chr) {
            if(index > str.length-1) return str;
            return str.substring(0,index) + chr + str.substring(index+1);
        },
        viewRelation(schema, id) {
            if(schema.settings) {
                if(schema.settings.readTableRoute) {
                    // let myWindow = window.open(schema.settings.readTableRoute + '?params[id]=' + id, "_blank");
                    let params = {"id" : id
                }

                    let myWindow = window.open(this.route(schema.settings.readTableRoute, {
                        _query: {
                            params
                        },
                    }), "_blank");
                    myWindow.focus();
                }
            }
        },
        selected(schema) {
            this.$emit('onLineSelected', this.data[schema.form])
        },
        format_date(value){
            if (value) {
                // return moment(String(value)).format('DD/MM/YY HH:mm:ss')
                return moment(String(value)).format('DD/MM/YY')
            }
        },
        modalPreview(schema) {
            if(schema.settings.readTableRoute) {
                this.$emit("modalPreview", this.data.id);
            }

        }

    },
}
</script>

<style scoped>

</style>
