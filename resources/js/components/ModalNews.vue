<template>
    <div class="modal fade" id="idmodal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 50%!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="!editMode" class="modal-title">Create News</h5>
                    <h5 v-show="editMode" class="modal-title">Update News</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form-news :news="news" :edit-mode="editMode"></form-news>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FormNews from "./FormNews";
export default {
    name: "modalNews",
    props:['editMode','news'],
    components: {
        FormNews
    },
}
</script>

<style scoped>

</style>
