<?php

namespace App\Providers;

use App\commentsmol;
use App\Repository\CartRepository\CartRepositoryClass;
use App\Repository\CartRepository\CartRepositoryInterface;
use App\Repository\CategoryRtepository\Category_Maunfactur_Repository\Category_Maunfactur_Repository_Interface;
use App\Repository\CategoryRtepository\Category_Maunfactur_Repository\Eloquent_Category_Maunfactur_Repository;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use App\Repository\CategoryRtepository\EloquentCategoryRepository;
use App\Repository\ColorRtepository\ColorRtepositoryInterface;
use App\Repository\ColorRtepository\EloquentColorRepository;
use App\Repository\CommentRepository\CommentRepositoryInterface;
use App\Repository\CommentRepository\EloquentCommentRepository;
use App\Repository\ImageRepository\EloquentImageRepository;
use App\Repository\ImageRepository\ImageRtepositoryInterface;
use App\Repository\ManufactureRtepository\EloquentManufactureRepository;
use App\Repository\ManufactureRtepository\ManufactureRtepositoryInterface;


use App\Repository\MenuRepository\EloquentMenurRepository;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\Repository\OrderRtepository\EloquentOrder_DetailRepository;
use App\Repository\OrderRtepository\EloquentOrderRepository;
use App\Repository\OrderRtepository\Order_DetailRepositoryInterface;
use App\Repository\OrderRtepository\OrderRepositoryInterface;
use App\Repository\PayRtepository\EloquentPayRepository;
use App\Repository\PayRtepository\PayRtepositoryInterface;
use App\Repository\ProductsRtepository\EloquentProductsRepository;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use App\Repository\RollsRepository\EloquentRoll_userRepository;
use App\Repository\RollsRepository\EloquentRollRepository;
use App\Repository\RollsRepository\Roll_UserRepositoryInterface;
use App\Repository\RollsRepository\RollRepositoryInterface;
use App\Repository\ShippingRepository\EloquentShippingRepository;
use App\Repository\ShippingRepository\ShippingRepositoryInterface;
use App\Repository\SliderRepository\EloquentSliderRepository;
use App\Repository\SliderRepository\SliderRepositoryInterface;
use App\Repository\UserRepository\AdminRepository\AdminRepositoryInterface;
use App\Repository\UserRepository\AdminRepository\EloquentAdminRepository;
use App\Repository\UserRepository\EloquentUserRepository;
use App\Repository\UserRepository\UserRtepositoryInterface;
use App\Repository\ViewRepository\EloquentViewRepository;
use App\Repository\ViewRepository\ViewRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(CategoryRtepositoryInterface::class,EloquentCategoryRepository::class);
        $this->app->singleton(ManufactureRtepositoryInterface::class,EloquentManufactureRepository::class);
        $this->app->singleton(ColorRtepositoryInterface::class,EloquentColorRepository::class);
        $this->app->singleton(ProductsRtepositoryInterface::class,EloquentProductsRepository::class);
        $this->app->singleton(CommentRepositoryInterface::class,EloquentCommentRepository::class);
        $this->app->singleton(OrderRepositoryInterface::class,EloquentOrderRepository::class);
        $this->app->singleton(UserRtepositoryInterface::class,EloquentUserRepository::class);
        $this->app->singleton(MenuRtepositoryInterface::class,EloquentMenurRepository::class);
        $this->app->singleton(ShippingRepositoryInterface::class,EloquentShippingRepository::class);
        $this->app->singleton(SliderRepositoryInterface::class,EloquentSliderRepository::class);
        $this->app->singleton(RollRepositoryInterface::class,EloquentRollRepository::class);
        $this->app->singleton(Roll_UserRepositoryInterface::class,EloquentRoll_userRepository::class);
        $this->app->singleton(Order_DetailRepositoryInterface::class,EloquentOrder_DetailRepository::class);
        $this->app->singleton(PayRtepositoryInterface::class,EloquentPayRepository::class);
        $this->app->singleton(ViewRepositoryInterface::class,EloquentViewRepository::class);
        $this->app->singleton(CartRepositoryInterface::class,CartRepositoryClass::class);
        $this->app->singleton(Category_Maunfactur_Repository_Interface::class,Eloquent_Category_Maunfactur_Repository::class);
        $this->app->singleton(ImageRtepositoryInterface::class,EloquentImageRepository::class);
        $this->app->singleton(AdminRepositoryInterface::class,EloquentAdminRepository::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
