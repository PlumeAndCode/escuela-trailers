import React from "react";
import { View, ActivityIndicator, Text } from "react-native";
import { Colors } from "../../constants/colors";

interface LoadingProps {
    message?: string;
    fullScreen?: boolean;
}

export const Loading: React.FC<LoadingProps> = ({
    message = "Cargando...",
    fullScreen = false,
}) => {
    if (fullScreen) {
        return (
            <View className="flex-1 items-center justify-center bg-white">
                <ActivityIndicator size="large" color={Colors.primary[500]} />
                <Text className="text-slate-500 mt-4 text-base">{message}</Text>
            </View>
        );
    }

    return (
        <View className="items-center justify-center py-8">
            <ActivityIndicator size="small" color={Colors.primary[500]} />
            <Text className="text-slate-500 mt-2 text-sm">{message}</Text>
        </View>
    );
};
