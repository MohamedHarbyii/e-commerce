<?php

namespace Database\Factories;

use App\Models\Category; // تأكد أن هذا المسار صحيح لموديل Category
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // لاستخدام دالة Str::slug

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 1. ننشئ الاسم أولاً
        // نستخدم company أو words لأسماء أقسام واقعية
        $name = $this->faker->unique()->company . ' ' . $this->faker->word;

        return [
            'name'        => $name,
            'slug'        => Str::slug($name), // 2. ننشئ الـ slug من الاسم
            'image'       => $this->faker->imageUrl(640, 480, 'technics', true), // 3. صورة وهمية
            'description' => $this->faker->paragraph,
            'parent_id'   => null, // 4. الافتراضي هو قسم رئيسي (لا يوجد أب)
            'status'      => $this->faker->boolean(90), // 5. 90% من الحالات سيكون القسم 'active'
        ];
    }

    /**
     * حالة خاصة لإنشاء قسم فرعي (له أب)
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function subCategory(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                // هذا الكود سيقوم بإنشاء قسم أب جديد، أو اختيار قسم موجود عشوائياً
                'parent_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            ];
        });
    }

    /**
     * حالة خاصة لجعل القسم غير نشط (inactive)
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => false,
            ];
        });
    }
}
