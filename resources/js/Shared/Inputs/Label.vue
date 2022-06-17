<template>
    <p v-if="value || label" :class="classBox">
        <span v-if="label" class="text-gray-700" :class="classTitle">{{ label }}: </span>
        <span class="font-semibold" :class="classValue">
            <a v-if="relation && can(canLinked) && routeName" class="text-blue-500 hover:text-blue-800 cursor-pointer" @click="viewRelation">{{ value }}</a>
            <span v-else>{{ value }}</span>
            <span v-if="after">{{after}}</span>
        </span>
    </p>
</template>

<script>
export default {
    name: "Label",
    props: {
        label: {
            type: String,
            default: null
        },
        value: {
            type: [String, Number],
            default: null
        },
        relation: {
            type: Object,
            default: null
        },
        routeName: {
            type: String,
            default: null
        },
        canLinked: {
            type: String,
            default: null
        },
        after: {
            type: String,
            default: null
        },
        classBox: {
            type: String,
            default: 'mb-2 text-gray-700'
        },
        classTitle: {
            type: String,
            default: null
        },
        classValue: {
            type: String,
            default: null
        }
    },
    methods: {
        viewRelation() {
            let myWindow = window.open(route(this.routeName, {
                'params[id]': this.relation.id
            }), "_blank");
            myWindow.focus();
        },
    },
}
</script>

<style scoped>

</style>
