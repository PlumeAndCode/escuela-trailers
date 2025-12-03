import React, { useState } from "react";
import { View, Text, KeyboardAvoidingView, Platform, ScrollView } from "react-native";
import { router } from "expo-router";
import { useAuthStore } from "../../src/stores/authStore";
import { Button } from "../../src/components/ui/Button";
import { Input } from "../../src/components/ui/Input";

export default function LoginScreen() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const { login, isLoading, error, clearError } = useAuthStore();

    const handleLogin = async () => {
        clearError();
        const success = await login(email, password);
        if (success) {
            router.replace("/(tabs)");
        }
    };

    return (
        <KeyboardAvoidingView
            behavior={Platform.OS === "ios" ? "padding" : "height"}
            className="flex-1 bg-slate-900"
        >
            <ScrollView contentContainerStyle={{ flexGrow: 1 }} keyboardShouldPersistTaps="handled">
                {/* Header con logo */}
                <View className="items-center pt-20 pb-10">
                    <View className="w-24 h-24 bg-amber-500 rounded-full items-center justify-center mb-4">
                        <Text className="text-4xl">🚛</Text>
                    </View>
                    <Text className="text-3xl font-bold text-white">
                        Drive<Text className="text-amber-500">Master</Text> Pro
                    </Text>
                    <Text className="text-slate-400 mt-2">Escuela de Trailers</Text>
                </View>

                {/* Formulario */}
                <View className="flex-1 bg-white rounded-t-3xl px-6 pt-8">
                    <Text className="text-2xl font-bold text-slate-800 mb-2">Bienvenido</Text>
                    <Text className="text-slate-500 mb-8">Inicia sesión para continuar</Text>

                    {error && (
                        <View className="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
                            <Text className="text-red-600">{error}</Text>
                        </View>
                    )}

                    <Input
                        label="Correo electrónico"
                        placeholder="tu@email.com"
                        icon="mail-outline"
                        value={email}
                        onChangeText={setEmail}
                        keyboardType="email-address"
                        autoCapitalize="none"
                    />

                    <Input
                        label="Contraseña"
                        placeholder="••••••••"
                        icon="lock-closed-outline"
                        value={password}
                        onChangeText={setPassword}
                        isPassword
                    />

                    <Button
                        title="Iniciar Sesión"
                        onPress={handleLogin}
                        loading={isLoading}
                        className="mt-4"
                    />

                    <Text className="text-center text-slate-400 mt-6 text-sm">
                        Solo para clientes registrados
                    </Text>
                </View>
            </ScrollView>
        </KeyboardAvoidingView>
    );
}
