@extends('agent.layouts.app')

@section('title', 'ユーザー編集')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">ユーザー編集</h2>
    <form action="{{ route('agent.customer.update', $user->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="grid gap-6 mb-6 lg:grid-cols-2">
        <div>
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900">名前</label>
          <input type="text" id="name" name="name" value="{{ $user->name }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" required>
        </div>
        <div>
          <label for="initial" class="block mb-2 text-sm font-medium text-gray-900">イニシャル</label>
          <input type="text" id="initial" name="initial" value="{{ $user->initial }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
        </div>
        <div>
          <label for="position" class="block mb-2 text-sm font-medium text-gray-900">ポジション</label>
          <input type="text" id="position" name="position" value="{{ $user->position }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" required>
        </div>
        <div>
          <label for="status" class="block mb-2 text-sm font-medium text-gray-900">ステータス</label>
          <select id="status" name="status" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" required>
            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>アクティブ</option>
            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>非アクティブ</option>
            <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>保留中</option>
          </select>
        </div>
        <div>
          <label for="matching" class="block mb-2 text-sm font-medium text-gray-900">マッチング</label>
          <input type="number" id="matching" name="matching" value="{{ $user->matching }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" min="0" max="5" required>
        </div>
        <div>
          <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900">作成日</label>
          <input type="datetime-local" id="created_at" name="created_at" value="{{ $user->created_at->format('Y-m-d\TH:i') }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" required>
        </div>
        <!-- 新しいフィールド -->
        <div>
          <label for="age" class="block mb-2 text-sm font-medium text-gray-900">年齢</label>
          <input type="number" id="age" name="age" value="{{ $user->age }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
        </div>
        <div>
          <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">性別</label>
          <input type="text" id="gender" name="gender" value="{{ $user->gender }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
        </div>
        <div>
          <label for="desired_salary_min" class="block mb-2 text-sm font-medium text-gray-900">希望年収（下限）</label>
          <input type="number" id="desired_salary_min" name="desired_salary_min" value="{{ $user->desired_salary_min }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
        </div>
        <div>
          <label for="desired_salary_max" class="block mb-2 text-sm font-medium text-gray-900">希望年収（上限）</label>
          <input type="number" id="desired_salary_max" name="desired_salary_max" value="{{ $user->desired_salary_max }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
        </div>
        <div>
          <label for="catch_copy" class="block mb-2 text-sm font-medium text-gray-900">経歴キャッチコピー</label>
          <input type="text" id="catch_copy" name="catch_copy" value="{{ $user->catch_copy }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="60">
        </div>
        <div>
          <label for="career_description" class="block mb-2 text-sm font-medium text-gray-900">経歴概要</label>
          <input type="text" id="career_description" name="career_description" value="{{ $user->career_description }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="250">
        </div>
        <div>
          <label for="recommendation" class="block mb-2 text-sm font-medium text-gray-900">こんな企業におすすめ</label>
          <textarea id="recommendation" name="recommendation" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">{{ $user->recommendation }}</textarea>
        </div>
        <div>
          <label for="num_companies_worked" class="block mb-2 text-sm font-medium text-gray-900">経験社数</label>
          <input type="number" id="num_companies_worked" name="num_companies_worked" value="{{ $user->num_companies_worked }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
        </div>
        <div>
          <label for="skill_distribution" class="block mb-2 text-sm font-medium text-gray-900">スキル分布（低〜高）</label>
          <select id="skill_distribution" name="skill_distribution[]" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" multiple>
            <option value="low" {{ in_array('low', $user->skill_distribution ?? []) ? 'selected' : '' }}>低</option>
            <option value="medium" {{ in_array('medium', $user->skill_distribution ?? []) ? 'selected' : '' }}>中</option>
            <option value="high" {{ in_array('high', $user->skill_distribution ?? []) ? 'selected' : '' }}>高</option>
          </select>
        </div>
        <div>
          <label for="notable_achievements" class="block mb-2 text-sm font-medium text-gray-900">特筆実績</label>
          <textarea id="notable_achievements" name="notable_achievements" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">{{ $user->notable_achievements }}</textarea>
        </div>
      </div>
      <div class="flex justify-end space-x-4">
        <a href="{{ route('agent.customer.index') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
          キャンセル
        </a>
        <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
          更新
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
