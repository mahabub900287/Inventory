<template>
    <div></div>
</template>

<script>
import { onMounted } from "vue";
export default {
    name: "ExampleComponent",

    data() {
        return {};
    },
    onMounted() {
        nextTick(() => {
            $(".ic-select").selectpicker();
        });
    },
};
</script>
