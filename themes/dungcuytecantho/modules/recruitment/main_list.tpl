<!-- BEGIN: main -->
<div class="content-page-list content-page-list--recruitment">
    <div class="content-hero">
        <div class="content-hero__eyebrow">Tuyển dụng</div>
        <h1 class="content-hero__title">Cơ hội việc làm mới nhất</h1>
        <p class="content-hero__text">Theo dõi các vị trí đang tuyển, mô tả công việc và thông tin cần thiết để ứng tuyển nhanh chóng.</p>
    </div>

    <div class="content-card-list">
        <!-- BEGIN: loop -->
        <article class="content-card">
            <!-- BEGIN: image -->
            <a class="content-card__media" href="{DATA.link}" title="{DATA.title}">
                <img src="{DATA.image}" alt="{DATA.imagealt}" />
            </a>
            <!-- END: image -->
            <div class="content-card__body">
                <h3 class="content-card__title">
                    <a href="{DATA.link}" title="{DATA.title}">{DATA.title}</a>
                </h3>
                <p class="content-card__text">{DATA.description}</p>
                <a class="content-card__link" href="{DATA.link}" title="{DATA.title}">Xem chi tiết <i class="fa fa-angle-right"></i></a>
            </div>
        </article>
        <!-- END: loop -->
    </div>

    <div class="content-pagination">
        {GENERATE_PAGE}
    </div>
</div>
<!-- END: main -->
