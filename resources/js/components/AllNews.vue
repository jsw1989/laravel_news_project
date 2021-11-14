<template>
    <div>
        <h2 class="text-center">News List</h2>
        <section style="margin-top: 95px;" >
            <o-field grouped group-multiline>
                <o-select v-model="perPage" :disabled="!isPaginated">
                    <option value="5">5 per page</option>
                    <option value="10">10 per page</option>
                    <option value="15">15 per page</option>
                    <option value="20">20 per page</option>
                </o-select>
            </o-field>
            <o-table
                :data="news"
                :paginated="isPaginated"
                :per-page="perPage"
                :current-page.sync="currentPage"
                :striped="isStriped"
                :hoverable="isHoverable"
                :pagination-position="paginationPosition"
                :default-sort-direction="defaultSortDirection"
                :sort-icon="sortIcon"
                :sort-icon-size="sortIconSize"
                default-sort="incident_date"
                aria-next-label="Next page"
                aria-previous-label="Previous page"
                aria-page-label="Page"
                aria-current-label="Current page"
            >
                <o-table-column field="title" label="Title" width ="40" position="centered" sortable v-slot="props">
                    {{ props.row.title }}
                </o-table-column>
                <o-table-column field="content" label="Content"  width ="40" position="centered" sortable v-slot="props">
                    <span v-html="props.row.content"></span>
                </o-table-column>
                <o-table-column field="is_published" label="Is Published" width ="40" position="centered" sortable v-slot="props">
                  {{ (props.row.is_published == 1) ? "true":"false" }}
                </o-table-column>
                <o-table-column label="Actions"  width ="40" position="centered" v-slot="props">
                    <button @click="editModalWindow(props.row)" class="btn btn-primary" style="margin-right: 10px;">
                        <i class="fas fa-pen">Edit</i></button>
                    <button  @click="deleteProduct(props.row.id)" class="btn btn-danger">
                        <i class="fas fas fa-trash-alt">Delete</i></button>
                </o-table-column>
            </o-table>
        </section>

        <ModalNews :edit-mode="editMode" :news="currentnews">
        </ModalNews>


    </div>
</template>

<script>
import ModalNews from "./ModalNews";
export default {
    components: {ModalNews},
    data() {
        return {
            news: [],
            currentnews:{},
            editMode: false,
            isPaginated: true,
            isStriped: true,
            isHoverable: true,
            paginationPosition: 'bottom',
            defaultSortDirection: 'asc',
            sortIcon: 'chevron-up',
            sortIconSize: 'small',
            perPage: 5,
            currentSort:'id',
            currentSortDir:'desc',
            currentPage:1,
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/news/')
            .then(response => {
                this.news = response.data;
            });
    },
    methods: {
        deleteProduct(id) {
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: true
            }).then(isConfirm => {
                if(isConfirm.value === true) {
                    this.axios
                        .delete(`http://localhost:8000/api/news/${id}`)
                        .then(response => {
                            let i = this.news.map(data => data.id).indexOf(id);
                            this.news.splice(i, 1)
                        });
                }
            });
        },
        editModalWindow(news){
            this.editMode = true
            this.currentnews = news;
            $('#idmodal').modal('show');
        }
    }
}
</script>
<style scoped lang='scss'>
@import '../../sass/custom.scss';

</style>
