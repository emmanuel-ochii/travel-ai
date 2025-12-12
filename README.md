# Travel AI – Smart Travel Recommendation & Flight Search Assistant

## 🚀 Overview

Travel AI is an intelligent travel assistant built with **Laravel**, **Livewire**, and **Groq AI**, designed to make travel planning seamless. Users can search for flights, explore destinations, and chat with an AI-powered assistant that provides real-time recommendations.

---



### 🏠 Home Page

![Home Page](public/guest/images/appImage.png)

### ✈️ Flight Search

![Flight Search](screenshots/flight-search.png)

### 💬 AI Chat Widget

![AI Widget](screenshots/ai-widget.png)

### 🧾 Checkout Page

![Checkout](screenshots/checkout.png)

### 🛠️ Admin Panel (Filament)

![Admin Panel](screenshots/admin-panel.png)

---

## ✨ Features

### 🔍 Flight Search Engine

* One-way, round-trip, and multi-city
* Filters: Airlines, stops, prices
* Real-time sorting and dynamic updates
* Detailed checkout & traveler form

### 🤖 AI Travel Assistant (Groq-powered)

Helps users with:

* Destination recommendations
* Budget travel tips
* Airline comparisons
* Visa requirements
* Packing guides
* Weather and best travel dates

### 💬 Smart Floating Chat Widget

* Custom TravelAI persona
* Typing animation
* Real-time Groq chat completions
* Mobile-friendly design

### 🧾 Booking Flow

* Traveler details
* Price breakdown
* Smooth checkout UI

### 🛠️ Admin Dashboard (FilamentPHP)

* User management
* Flight search analytics
* Widget dashboards

---

## 🧠 AI Prompt Guide for Users

Help users ask better:

#### ✈️ Flight Search

```
Find flights from Lagos to Dubai on Feb 10 for 2 adults.
Show me cheap flights from Abuja to Accra next week.
Compare Qatar Airways vs Ethiopian Airlines.
```

#### 🌍 Destination Ideas

```
Suggest 3 holiday destinations under $500.
Where can I travel visa-free from Nigeria in March?
```

#### 🧳 Trip Planning

```
Plan a 5-day trip to Kigali with activities.
Give me a packing list for winter travel.
```

---

## 🏗️ Tech Stack

* Laravel 11
* Livewire v3
* TailwindCSS
* Groq LLaMA 3.3 70B
* FilamentPHP Admin
* MySQL

---

## ⚙️ Installation

```bash
git clone https://github.com/yourusername/travel-ai.git
cd travel-ai
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
```

### Add environment keys

```
GROQ_API_KEY=your_key
GROQ_API_URL=https://api.groq.com/openai/v1
GROQ_MODEL=llama-3.3-70b-versatile
```

### Run migrations

```bash
php artisan migrate
```

### Start server

```bash
php artisan serve
```

---

## 📌 Project Structure

```
app/
  Livewire/
    Flight/
    ChatWidget.php
  Services/
    AiService.php
resources/views/livewire/
routes/web.php
config/services.php
```

---

## 🚧 Current Status

Core modules are working:

* AI Chat
* Flight search UI
* Checkout flow
* Admin dashboard

Development paused temporarily for documentation & cleanup.

---

## 🗺️ Roadmap

* Payment gateway integration
* Auto-booking API
* Saved trips + wishlists
* More AI-powered features

---

## 👨‍💻 Developer

Built by **Emmanuel** using modern Laravel + AI-driven design.

---

## 📄 License

MIT (or update to your chosen license).

---

> After uploading your screenshots, update the image paths above.
